<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeRequest;
use App\Models\Category;
use App\Models\Type;
use App\Models\Views\Type as ViewsType;
use DataTables;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        CheckPermission::checkAuth('Listar Tipos');

        if ($request->ajax()) {
            $types = ViewsType::all();
            $token = csrf_token();

            return Datatables::of($types)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($token) {
                    $btn = '<a class="btn btn-xs btn-primary mx-1 shadow" title="Editar" href="types/'.$row->id.'/edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>'.'<form method="POST" action="types/'.$row->id.'" class="btn btn-xs px-0"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.$token.'"><button class="btn btn-xs btn-danger mx-1 shadow" title="Excluir" onclick="return confirm(\'Confirma a exclusão deste tipo?\')"><i class="fa fa-lg fa-fw fa-trash"></i></button></form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        CheckPermission::checkAuth('Criar Tipos');
        $categories = Category::orderBy('name')->get();

        return view('admin.types.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        CheckPermission::checkAuth('Criar Tipos');

        $data = $request->all();

        $type = Type::create($data);

        if ($type->save()) {
            return redirect()
                ->route('admin.types.index')
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
        CheckPermission::checkAuth('Editar Tipos');

        $type = Type::find($id);

        if (! $type) {
            abort(403, 'Acesso não autorizado');
        }

        $categories = Category::orderBy('name')->get();

        return view('admin.types.edit', compact('type', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, string $id)
    {
        CheckPermission::checkAuth('Editar Tipos');

        $type = Type::find($id);

        if (! $type) {
            abort(403, 'Acesso não autorizado');
        }

        $data = $request->all();

        if ($type->update($data)) {
            return redirect()
                ->route('admin.types.index')
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
        CheckPermission::checkAuth('Excluir Tipos');

        $type = Type::find($id);

        if (! $type) {
            abort(403, 'Acesso não autorizado');
        }

        if ($type->delete()) {
            return redirect()
                ->route('admin.types.index')
                ->with('success', 'Exclusão realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar!');
        }
    }
}
