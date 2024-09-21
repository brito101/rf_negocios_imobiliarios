<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgencyRequest;
use App\Models\Agency;
use App\Models\Broker;
use App\Models\User;
use App\Models\Views\Agency as ViewsAgency;
use App\Models\Views\User as ViewsUser;
use DataTables;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        CheckPermission::checkAuth('Listar Agências');

        $agencies = ViewsAgency::all();

        if ($request->ajax()) {

            $token = csrf_token();

            return Datatables::of($agencies)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($token) {
                    $btn = '<a class="btn btn-xs btn-primary mx-1 shadow" title="Editar" href="agencies/'.$row->id.'/edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>'.
                        '<form method="POST" action="agencies/'.$row->id.'" class="btn btn-xs px-0"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.$token.'"><button class="btn btn-xs btn-danger mx-1 shadow" title="Excluir" onclick="return confirm(\'Confirma a exclusão desta agência?\')"><i class="fa fa-lg fa-fw fa-trash"></i></button></form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.agencies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        CheckPermission::checkAuth('Criar Agências');

        $brokers = ViewsUser::whereIn('type', ['Corretor'])->get();

        return view('admin.agencies.create', compact('brokers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgencyRequest $request)
    {
        CheckPermission::checkAuth('Criar Agências');

        $agency = Agency::create($request->all());

        if ($agency->save()) {
            $brokers = $request->brokers;
            if ($brokers && count($brokers) > 0) {
                $users = User::whereIn('id', $brokers)->pluck('id');
                foreach ($users as $user) {
                    $broker = new Broker;
                    $broker->create([
                        'user_id' => $user,
                        'agency_id' => $agency->id,
                    ]);
                }
            }

            return redirect()
                ->route('admin.agencies.index')
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
    public function show(string $id)
    {
        CheckPermission::checkAuth('Listar Agências');

        return redirect()->route('admin.agencies.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        CheckPermission::checkAuth('Editar Agências');

        $agency = Agency::with('brokers')->find($id);

        if (! $agency) {
            abort(403, 'Acesso não autorizado');
        }

        $brokers = ViewsUser::whereIn('type', ['Corretor'])->get();

        return view('admin.agencies.edit', compact('agency', 'brokers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgencyRequest $request, string $id)
    {
        CheckPermission::checkAuth('Editar Agências');

        $agency = Agency::find($id);

        if (! $agency) {
            abort(403, 'Acesso não autorizado');
        }

        $brokers = $request->brokers;
        if ($brokers && count($brokers) > 0) {
            $users = User::whereIn('id', $brokers)->pluck('id');
            Broker::whereNotIn('user_id', $users)->where('agency_id', $agency->id)->delete();
            foreach ($users as $user) {
                $broker = new Broker;
                $broker->create([
                    'user_id' => $user,
                    'agency_id' => $agency->id,
                ]);
            }
        } else {
            Broker::where('agency_id', $agency->id)->delete();
        }

        if ($agency->update($request->all())) {
            return redirect()
                ->route('admin.agencies.index')
                ->with('success', 'Edição realizada!');
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
        CheckPermission::checkAuth('Excluir Agências');

        $agency = Agency::find($id);

        if (! $agency) {
            abort(403, 'Acesso não autorizado');
        }

        if ($agency->delete()) {
            Broker::where('agency_id', $agency->id)->delete();

            return redirect()
                ->route('admin.agencies.index')
                ->with('success', 'Exclusão realizada!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir!');
        }
    }
}
