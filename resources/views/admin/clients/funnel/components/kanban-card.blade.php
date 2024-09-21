<div draggable="true" class="draggable-item" data-client="{{ $client->id }}">
    <div class="card card-secondary card-outline">
        <div class="card-header" data-toggle="collapse" href="#collapse{{ $client->id }}" role="button"
            aria-expanded="false" aria-controls="collapse{{ $client->id }}">
            <h5 class="card-title" data-client_id="{{ $client->id }}">
                <span class="btn btn-tool btn-link">#{{ $client->id }}</span>{{ $client->name }}
            </h5>
        </div>
        @if ($client->cell)
            <div class="text-center">
                <span>{{ $client->cell }}</span>
            </div>
        @endif
        <div>
            <a href="{{ route('admin.clients.edit', ['client' => $client->id]) }}" target="_blank"
                class="btn btn-tool text-right w-100" title="Editar">Editar</a>
        </div>

        <div class="collapse" id="collapse{{ $client->id }}">
            <div class="card-body">
                @if ($client->broker)
                    <p>
                        <b>Corretor:</b><br /> <span class="kanban_seller">{{ $client->broker }}</span>
                    </p>
                @endif
                @if ($client->property_title)
                    <p>
                        <b>Imóvel:</b><br /> <span class="kanban_description">{{ $client->property_title }}</span>
                    </p>
                @endif
                @if ($client->contact_message)
                    <p>
                        <b>Mensagem:</b><br /> <span class="kanban_description"> {{ $client->contact_message }}</span>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
