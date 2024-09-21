<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CheckPermission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientFunnelRequest;
use App\Models\Client;
use App\Models\Step;
use App\Models\Views\Client as ViewsClient;
use Illuminate\Support\Facades\Auth;

class ClientFunnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        CheckPermission::checkAuth('Listar Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $clients = ViewsClient::all();
        } else {
            $clients = ViewsClient::whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->get();
        }

        $steps = Step::all();

        return view('admin.clients.funnel.index', \compact('steps', 'clients'));
    }

    public function updateKanban(ClientFunnelRequest $request)
    {
        CheckPermission::checkAuth('Editar Clientes');

        if (Auth::user()->hasRole('Programador|Administrador')) {
            $client = Client::find($request->client);
        } else {
            $client = Client::where('id', $request->client)->whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->first();
        }

        if (! $client) {
            abort(403, 'Acesso não autorizado');
        }

        if ($client->update(['step_id' => $request->step])) {
            return response()->json(['message' => 'success']);
        }
    }
}
