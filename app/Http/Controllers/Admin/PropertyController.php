<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyChangeImage;
use App\Http\Requests\Admin\PropertyDeleteImage;
use App\Http\Requests\Admin\PropertyRequest;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Differential;
use App\Models\Experience;
use App\Models\Property;
use App\Models\PropertyDifferentials;
use App\Models\PropertyImage;
use App\Models\Type;
use App\Models\Views\Property as ViewsProperty;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        CheckPermission::checkAuth('Listar Propriedades');

        if ($request->ajax()) {

            if (Auth::user()->hasRole('Programador|Administrador')) {
                $properties = ViewsProperty::all();
            } else {
                $agencies = Auth::user()->brokers->pluck('agency_id');
                $properties = ViewsProperty::whereIn('agency_id', $agencies)->get();
            }

            $token = csrf_token();

            return Datatables::of($properties)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($token) {
                    $btn = '<a class="btn btn-xs btn-success mx-1 shadow" title="Visualizar" target="_blank" href="'.
                        route('web.property', $row->slug).
                        '"><i class="fa fa-lg fa-fw fa-eye"></i></a>'.

                        '<a class="btn btn-xs btn-secondary mx-1 shadow" title="Campanha" target="_blank" href="'.
                        route('web.campaign', $row->slug).
                        '"><i class="fa fa-lg fa-fw fa-rocket"></i></a>'

                        .'<a class="btn btn-xs btn-primary mx-1 shadow" title="Editar" href="properties/'.$row->id.'/edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>'.'<form method="POST" action="properties/'.$row->id.'" class="btn btn-xs px-0"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.$token.'"><button class="btn btn-xs btn-danger mx-1 shadow" title="Excluir" onclick="return confirm(\'Confirma a exclusão desta propriedade?\')"><i class="fa fa-lg fa-fw fa-trash"></i></button></form>';

                    return $btn;
                })
                ->addColumn('cover', function ($row) {
                    if (! $row->cover) {
                        return '<div class="d-flex justify-content-center align-items-center"><img src='.asset('img/share.webp').' class="img-thumbnail d-block" width="360" height="207" alt="'.$row->title.'" title="'.$row->title.'"/></div>';
                    } else {
                        return '<div class="d-flex justify-content-center align-items-center"><img src='.url('storage/properties/min/'.$row->cover).' class="img-thumbnail d-block" width="360" height="207" alt="'.$row->title.'" title="'.$row->title.'"/></div>';
                    }
                })
                ->rawColumns(['action', 'cover'])
                ->make(true);
        }

        return view('admin.properties.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        CheckPermission::checkAuth('Criar Propriedades');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $agencies = Agency::all();
        } else {
            $agencies = Agency::whereIn('id', Auth::user()->brokers->pluck('agency_id'))->get();
        }

        $types = Type::orderBy('name')->get();
        $experiences = Experience::orderBy('name')->get();
        $differentials = Differential::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();

        return view('admin.properties.create', compact('agencies', 'types', 'experiences', 'differentials', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        CheckPermission::checkAuth('Criar Propriedades');

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $name = Str::slug(mb_substr($data['title'], 0, 100)).time();
            $extension = $request->cover->extension();
            $nameFile = "{$name}.{$extension}";

            $data['cover'] = $nameFile;

            $destinationPath = storage_path().'/app/public/properties';
            $destinationPathMedium = storage_path().'/app/public/properties/medium';
            $destinationPathMin = storage_path().'/app/public/properties/min';

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            if (! file_exists($destinationPathMedium)) {
                mkdir($destinationPathMedium, 755, true);
            }

            if (! file_exists($destinationPathMin)) {
                mkdir($destinationPathMin, 755, true);
            }

            $img = Image::make($request->cover)->resize(null, 490, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop(860, 490)->save($destinationPath.'/'.$nameFile);

            $imgMedium = Image::make($request->cover)->resize(null, 385, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop(675, 385)->save($destinationPathMedium.'/'.$nameFile);

            $imgMin = Image::make($request->cover)->resize(null, 207, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop(360, 207)->save($destinationPathMin.'/'.$nameFile);
        }

        $property = Property::create($data);

        $differentialsIds = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'differential_') && ($value == 'on' || $value == true || $value = '1')) {
                $differentialsIds[] = (str_replace('differential_', '', $key));
            }
        }

        if ($property->save()) {

            $slug = Str::slug(mb_substr($property->title, 0, 100));
            if (Property::where('slug', $slug)->first()) {
                $property->update(['slug' => $slug.'-'.$property->id]);
            } else {
                $property->update(['slug' => $slug]);
            }

            if ($request->images) {
                $rules = [
                    'image' => 'mimes:jpeg,jpg,png|required|max:10000',
                ];

                $validator = Validator::make($request->images, $rules);

                if ($validator) {
                    foreach ($request->images as $key => $img) {
                        $name = Str::slug($request->title.'-'.$key).'-'.time();
                        $extension = $img->extension();

                        $nameFile = "$name.$extension";
                        $i['location'] = $nameFile;
                        $i['order'] = $key;
                        $i['property_id'] = $property->id;
                        $file = PropertyImage::create($i);
                        $file->save();

                        $destinationPath = storage_path().'/app/public/properties/album/';

                        if (! file_exists($destinationPath)) {
                            mkdir($destinationPath, 755, true);
                        }

                        $img = Image::make($img)->resize(null, 490, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->crop(860, 490)->save($destinationPath.'/'.$nameFile);

                        $img->save($destinationPath.'/'.$nameFile);
                    }
                } else {
                    redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Falha ao fazer o upload das imagens da propriedade');
                }
            }

            if (count($differentialsIds) > 0) {
                $differentials = Differential::whereIn('id', $differentialsIds)->pluck('id');
                foreach ($differentials as $differential) {
                    $pivot = new PropertyDifferentials;
                    $pivot->create([
                        'property_id' => $property->id,
                        'differential_id' => $differential,
                    ]);
                }
            }

            return redirect()
                ->route('admin.properties.index')
                ->with('success', 'Cadastro realizado!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        CheckPermission::checkAuth('Editar Propriedades');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $agencies = Agency::all();
            $property = Property::with('differentials', 'images')->find($id);
        } else {
            $agencies = Auth::user()->brokers->pluck('agency_id');
            $property = Property::whereIn('agency_id', $agencies)->with('differentials', 'images')->find($id);
        }

        if (! $property) {
            abort(403, 'Acesso não autorizado');
        }

        $types = Type::orderBy('name')->get();
        $experiences = Experience::orderBy('name')->get();
        $differentials = Differential::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();

        return view('admin.properties.edit', compact('agencies', 'property', 'types', 'experiences', 'differentials', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, string $id)
    {
        CheckPermission::checkAuth('Editar Propriedades');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $agencies = Agency::all();
            $property = Property::with('differentials', 'images')->find($id);
        } else {
            $agencies = Auth::user()->brokers->pluck('agency_id');
            $property = Property::whereIn('agency_id', $agencies)->with('differentials', 'images')->find($id);
        }

        if (! $property) {
            abort(403, 'Acesso não autorizado');
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $slug = Str::slug(mb_substr($data['title'], 0, 100));
        if (Property::where('slug', $slug)->where('id', '!=', $property->id)->first()) {
            $data['slug'] = $slug.'-'.$property->id;
        } else {
            $data['slug'] = $slug;
        }

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $name = Str::slug(mb_substr($data['title'], 0, 100)).time();
            $extension = $request->cover->extension();
            $nameFile = "{$name}.{$extension}";

            $data['cover'] = $nameFile;

            $destinationPath = storage_path().'/app/public/properties';
            $destinationPathMedium = storage_path().'/app/public/properties/medium';
            $destinationPathMin = storage_path().'/app/public/properties/min';

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            if (! file_exists($destinationPathMedium)) {
                mkdir($destinationPathMedium, 755, true);
            }

            if (! file_exists($destinationPathMin)) {
                mkdir($destinationPathMin, 755, true);
            }

            $img = Image::make($request->cover)->resize(null, 490, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop(860, 490)->save($destinationPath.'/'.$nameFile);

            $imgMedium = Image::make($request->cover)->resize(null, 385, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop(675, 385)->save($destinationPathMedium.'/'.$nameFile);

            $imgMin = Image::make($request->cover)->resize(null, 207, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop(360, 207)->save($destinationPathMin.'/'.$nameFile);
        }

        $differentialsIds = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'differential_') && ($value == 'on' || $value == true || $value = '1')) {
                $differentialsIds[] = (str_replace('differential_', '', $key));
            }
        }

        if ($property->update($data)) {

            if ($request->images) {
                $rules = [
                    'image' => 'mimes:jpeg,jpg,png|required|max:10000',
                ];

                $validator = Validator::make($request->images, $rules);
                $lastImage = $property->images->last()->order ?? 0;

                if ($validator) {
                    foreach ($request->images as $key => $img) {
                        $name = Str::slug($request->title.'-'.$key).'-'.time();
                        $extension = $img->extension();

                        $nameFile = "$name.$extension";
                        $i['location'] = $nameFile;
                        $i['order'] = $lastImage + 1 + $key;
                        $i['property_id'] = $property->id;
                        $file = PropertyImage::create($i);
                        $file->save();

                        $destinationPath = storage_path().'/app/public/properties/album/';

                        if (! file_exists($destinationPath)) {
                            mkdir($destinationPath, 755, true);
                        }

                        $img = Image::make($img)->resize(null, 490, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->crop(860, 490)->save($destinationPath.'/'.$nameFile);

                        $img->save($destinationPath.'/'.$nameFile);
                    }
                } else {
                    redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Falha ao fazer o upload das imagens da propriedade');
                }
            }

            $property->differentials()->delete();
            if (count($differentialsIds) > 0) {
                $differentials = Differential::whereIn('id', $differentialsIds)->pluck('id');
                foreach ($differentials as $differential) {
                    $pivot = new PropertyDifferentials;
                    $pivot->create([
                        'property_id' => $property->id,
                        'differential_id' => $differential,
                    ]);
                }
            }

            return redirect()
                ->route('admin.properties.index')
                ->with('success', 'Cadastro realizado!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->hasRole('Programador|Administrador')) {
            $property = Property::find($id);
        } else {
            $agencies = Auth::user()->brokers->pluck('agency_id');
            $property = Property::whereIn('agency_id', $agencies)->find($id);
        }

        if (! $property) {
            abort(403, 'Acesso não autorizado');
        }

        if ($property->delete()) {
            return redirect()
                ->route('admin.properties.index')
                ->with('success', 'Exclusão realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar!');
        }

        CheckPermission::checkAuth('Excluir Propriedades');
    }

    /**
     * @param  Request  $request
     */
    public function imageDelete(PropertyDeleteImage $request): JsonResponse
    {
        CheckPermission::checkAuth('Editar Propriedades');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $property = Property::find($request->property);
        } else {
            $agencies = Auth::user()->brokers->pluck('agency_id');
            $property = Property::whereIn('agency_id', $agencies)->find($request->property);
        }

        if (! $property) {
            return response()->json(['message' => 'fail']);
        }

        $image = PropertyImage::where('id', $request->image)->where('property_id', $property->id)->first();

        if (! $image) {
            return response()->json(['message' => 'fail']);
        }

        if ($image) {
            $image->delete();

            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'fail']);
        }
    }

    /**
     * @param  Request  $request
     */
    public function imagesOrder(PropertyChangeImage $request): JsonResponse
    {
        CheckPermission::checkAuth('Editar Propriedades');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $property = Property::find($request->property);
        } else {
            $agencies = Auth::user()->brokers->pluck('agency_id');
            $property = Property::whereIn('agency_id', $agencies)->find($request->property);
        }

        if (! $property) {
            return response()->json(['message' => 'fail']);
        }

        $currentImage = PropertyImage::where('property_id', $property->id)->where('order', $request->old_position)->first();
        $changeImage = PropertyImage::where('property_id', $property->id)->where('order', $request->current_position)->first();

        if (! $currentImage && ! $changeImage) {
            return response()->json(['message' => 'fail']);
        }

        if ($currentImage && $changeImage) {
            $currentImage->order = $request->current_position;
            $currentImage->update();
            $changeImage->order = $request->old_position;
            $changeImage->update();

            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'fail']);
        }
    }
}
