<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DifferentialRequest;
use App\Models\Differential;
use App\Models\Views\Differential as ViewsDifferential;
use DataTables;
use Illuminate\Http\Request;

class DifferentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        CheckPermission::checkAuth('Listar Diferenciais');

        if ($request->ajax()) {
            $differentials = ViewsDifferential::all();
            $token = csrf_token();

            return Datatables::of($differentials)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($token) {
                    $btn = '<a class="btn btn-xs btn-primary mx-1 shadow" title="Editar" href="differentials/'.$row->id.'/edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>'.'<form method="POST" action="differentials/'.$row->id.'" class="btn btn-xs px-0"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.$token.'"><button class="btn btn-xs btn-danger mx-1 shadow" title="Excluir" onclick="return confirm(\'Confirma a exclusão deste diferencial?\')"><i class="fa fa-lg fa-fw fa-trash"></i></button></form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.differentials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        CheckPermission::checkAuth('Criar Diferenciais');

        return view('admin.differentials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DifferentialRequest $request)
    {
        CheckPermission::checkAuth('Criar Diferenciais');

        $data = $request->all();

        $differential = Differential::create($data);

        if ($differential->save()) {
            return redirect()
                ->route('admin.differentials.index')
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
        CheckPermission::checkAuth('Editar Diferenciais');

        $differential = Differential::find($id);

        if (! $differential) {
            abort(403, 'Acesso não autorizado');
        }

        return view('admin.differentials.edit', compact('differential'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DifferentialRequest $request, string $id)
    {
        CheckPermission::checkAuth('Editar Diferenciais');

        $differential = Differential::find($id);

        if (! $differential) {
            abort(403, 'Acesso não autorizado');
        }

        $data = $request->all();

        if ($differential->update($data)) {
            return redirect()
                ->route('admin.differentials.index')
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
        CheckPermission::checkAuth('Excluir Diferenciais');

        $differential = Differential::find($id);

        if (! $differential) {
            abort(403, 'Acesso não autorizado');
        }

        if ($differential->delete()) {
            return redirect()
                ->route('admin.differentials.index')
                ->with('success', 'Exclusão realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar!');
        }
    }
}
