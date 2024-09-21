<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExperienceRequest;
use App\Models\Experience;
use App\Models\Views\Experience as ViewsExperience;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        CheckPermission::checkAuth('Listar Experiências');

        $experiences = ViewsExperience::all();

        if ($request->ajax()) {
            $token = csrf_token();

            return Datatables::of($experiences)
                ->addIndexColumn()
                ->addColumn('cover', function ($row) {
                    $img = '<img src="'.$row->cover.'" alt="'.$row->name.'" class="img-circle img-size-32 mr-2 border" style="object-fit: cover; width:75px; height: 75px; aspect-ratio: 1;">';

                    return $img;
                })
                ->addColumn('action', function ($row) use ($token) {
                    $btn = '<a class="btn btn-xs btn-primary mx-1 shadow" title="Editar" href="experiences/'.$row->id.'/edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>'.'<form method="POST" action="experiences/'.$row->id.'" class="btn btn-xs px-0"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.$token.'"><button class="btn btn-xs btn-danger mx-1 shadow" title="Excluir" onclick="return confirm(\'Confirma a exclusão desta experiência?\')"><i class="fa fa-lg fa-fw fa-trash"></i></button></form>';

                    return $btn;
                })
                ->rawColumns(['action', 'cover'])
                ->make(true);
        }

        return view('admin.experiences.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        CheckPermission::checkAuth('Criar Experiências');

        return view('admin.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceRequest $request)
    {
        CheckPermission::checkAuth('Criar Experiências');

        $data = $request->all();

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $name = Str::slug(mb_substr($data['name'], 0, 100)).time();
            $extension = $request->cover->extension();
            $nameFile = "{$name}.{$extension}";

            $data['cover'] = '/storage/experiences/'.$nameFile;

            $destinationPath = storage_path().'/app/public/experiences';

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            $img = Image::make($request->cover);
            $img->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath.'/'.$nameFile);
        }

        $experience = Experience::create($data);

        if ($experience->save()) {
            return redirect()
                ->route('admin.experiences.index')
                ->with('success', 'Cadastro realizado!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        CheckPermission::checkAuth('Editar Experiências');

        $experience = Experience::find($id);

        if (! $experience) {
            abort(403, 'Acesso não autorizado');
        }

        return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceRequest $request, string $id)
    {
        CheckPermission::checkAuth('Editar Experiências');

        $experience = Experience::find($id);

        if (! $experience) {
            abort(403, 'Acesso não autorizado');
        }

        $data = $request->all();

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $name = Str::slug(mb_substr($data['name'], 0, 100)).time();
            $extension = $request->cover->extension();
            $nameFile = "{$name}.{$extension}";

            $imagePath = storage_path().'/app/public/experiences/'.(array_reverse(explode('/', $experience->cover))[0]);

            if (File::isFile($imagePath)) {
                unlink($imagePath);
            }

            $data['cover'] = '/storage/experiences/'.$nameFile;

            $destinationPath = storage_path().'/app/public/experiences';

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 755, true);
            }

            $img = Image::make($request->cover);
            $img->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath.'/'.$nameFile);

            if (! $img) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Falha ao fazer o upload da imagem');
            }
        }

        if ($experience->update($data)) {
            return redirect()
                ->route('admin.experiences.index')
                ->with('success', 'Atualização realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CheckPermission::checkAuth('Excluir Experiências');

        $experience = Experience::find($id);

        if (! $experience) {
            abort(403, 'Acesso não autorizado');
        }

        if ($experience->delete()) {
            return redirect()
                ->route('admin.experiences.index')
                ->with('success', 'Exclusão realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar!');
        }
    }
}
