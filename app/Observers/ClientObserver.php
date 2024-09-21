<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\ClientHistory;
use Illuminate\Support\Facades\Auth;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     *
     * @return void
     */
    public function created(Client $client)
    {
        $history = new ClientHistory;
        $history->client_id = $client->id;
        $history->action = 'criado';
        $history->step_id = $client->step_id;
        $history->user_id = $client->user_id;
        $history->agency_id = $client->agency_id;
        $history->saveQuietly();
    }

    /**
     * Handle the Client "updated" event.
     *
     * @return void
     */
    public function updated(Client $client)
    {
        $history = new ClientHistory;
        $history->client_id = $client->id;
        $history->action = 'editado';
        $history->step_id = $client->step_id;
        $history->user_id = Auth::user()->id;
        $history->agency_id = $client->agency_id;
        $history->saveQuietly();
    }

    /**
     * Handle the Client "deleted" event.
     *
     * @return void
     */
    public function deleted(Client $client)
    {
        $history = new ClientHistory;
        $history->client_id = $client->id;
        $history->action = 'deletado';
        $history->step_id = $client->step_id;
        $history->user_id = Auth::user()->id;
        $history->agency_id = $client->agency_id;
        $history->saveQuietly();
    }

    /**
     * Handle the Client "restored" event.
     *
     * @return void
     */
    public function restored(Client $client)
    {
        $history = new ClientHistory;
        $history->client_id = $client->id;
        $history->action = 'restaurado';
        $history->step_id = $client->step_id;
        $history->user_id = Auth::user()->id;
        $history->agency_id = $client->agency_id;
        $history->saveQuietly();
    }

    /**
     * Handle the Client "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        $history = new ClientHistory;
        $history->client_id = $client->id;
        $history->action = 'deletado forçadamente';
        $history->step_id = $client->step_id;
        $history->user_id = Auth::user()->id;
        $history->agency_id = $client->agency_id;
        $history->saveQuietly();
    }
}
