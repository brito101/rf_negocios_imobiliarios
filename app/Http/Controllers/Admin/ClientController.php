<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Helpers\TextProcessor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\Agency;
use App\Models\Client;
use App\Models\ClientHistory;
use App\Models\Step;
use App\Models\Views\Client as ViewsClient;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        CheckPermission::checkAuth('Listar Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $clients = ViewsClient::all();
        } else {
            $clients = ViewsClient::whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->get();
        }

        if ($request->ajax()) {

            $token = csrf_token();

            return Datatables::of($clients)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($token) {
                    $btn = '<a class="btn btn-xs btn-dark mx-1 shadow" title="Timeline" href="clients/timeline/'.$row->id.'"><i class="fa fa-lg fa-fw fa-clock"></i></a>'.
                        '<a class="btn btn-xs btn-primary mx-1 shadow" title="Editar" href="clients/'.$row->id.'/edit"><i class="fa fa-lg fa-fw fa-pen"></i></a>'.
                        '<form method="POST" action="clients/'.$row->id.'" class="btn btn-xs px-0"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="'.$token.'"><button class="btn btn-xs btn-danger mx-1 shadow" title="Excluir" onclick="return confirm(\'Confirma a exclusão deste cliente?\')"><i class="fa fa-lg fa-fw fa-trash"></i></button></form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        CheckPermission::checkAuth('Criar Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $agencies = Agency::all();
        } else {
            $agencies = ViewsClient::whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->get();
        }

        $steps = Step::all();

        return view('admin.clients.create', compact('agencies', 'steps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {

        CheckPermission::checkAuth('Criar Clientes');

        if (! Auth::user()->hasRole('Programador|Administrador')) {
            $agency = Agency::whereIn('id', Auth::user()->brokers->pluck('agency_id'))->where('id', $request->agency_id)->first();

            if (! $agency) {
                abort(403, 'Acesso não autorizado');
            }
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if ($request->observations) {
            $data['observations'] = TextProcessor::store($request->name, 'clients', $request->observations);
        }

        $client = Client::create($data);

        if ($client->save()) {
            return redirect()
                ->route('admin.clients.index')
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
        CheckPermission::checkAuth('Editar Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $agencies = Agency::all();
            $client = Client::find($id);
        } else {
            $agencies = ViewsClient::whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->get();
            $client = Client::where('id', $id)->whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->first();
        }

        if (! $client) {
            abort(403, 'Acesso não autorizado');
        }

        $steps = Step::all();

        return view('admin.clients.edit', compact('client', 'agencies', 'steps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        CheckPermission::checkAuth('Editar Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $client = Client::find($id);
        } else {
            $agency = Agency::whereIn('id', Auth::user()->brokers->pluck('agency_id'))->where('id', $request->agency_id)->first();

            if (! $agency) {
                abort(403, 'Acesso não autorizado');
            }

            $client = Client::where('id', $id)->whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->first();
        }

        if (! $client) {
            abort(403, 'Acesso não autorizado');
        }

        $data = $request->all();

        if ($request->observations) {
            $data['observations'] = TextProcessor::store($request->name, 'clients', $request->observations);
        }

        if ($client->update($data)) {
            return redirect()
                ->route('admin.clients.index')
                ->with('success', 'Edição realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao editar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CheckPermission::checkAuth('Excluir Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $client = Client::find($id);
        } else {
            $client = Client::where('id', $id)->whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->first();
        }

        if (! $client) {
            abort(403, 'Acesso não autorizado');
        }

        if ($client->delete()) {
            return redirect()
                ->route('admin.clients.index')
                ->with('success', 'Exclusão realizada!');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao excluir!');
        }
    }

    public function timeline($id)
    {
        if (! Auth::user()->hasPermissionTo('Acessar Clientes')) {
            abort(403, 'Acesso não autorizado');
        }
        if (Auth::user()->hasRole('Programador|Administrador')) {
            $client = Client::find($id);
        } else {
            $client = Client::where('id', $id)->whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->first();
        }

        if (! $client) {
            abort(403, 'Acesso não autorizado');
        }

        if (! $client) {
            abort(403, 'Acesso não autorizado');
        }

        $histories = ClientHistory::where('client_id', $client->id)
            ->orderBy('created_at', 'desc')
            ->with('client')
            ->with('agency')
            ->get();

        return view('admin.clients.history', compact('client', 'histories'));
    }
}
