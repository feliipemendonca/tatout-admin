<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-4 col-lg-8">
                <h5>Lista</h5>
            </div>
            <div class="col-8 col-lg-4">
                <div class="form-group form-control-search">
                    <input wire:model="search" type="search" class="form-control" placeholder="Pesquisar">
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Usuário</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">ID Modelo</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Criado</th>
                    <th scope="col">Atualizado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items->lazy() as $item)
                <tr>
                    <td>
                        {{ $item->user->name }}
                    </td>
                    <td>
                        {{ $item->auditable_type }}
                    </td>
                    <td>
                        {{ $item->auditable_id }}
                    </td>
                    <td>
                        <p class="badge rounded-pill shadow-none pill-badge-{{ $item->event == "created" ? 'success' : '' }}{{ $item->event == "deleted" ? 'danger' : ''  }}{{ $item->event == "updated" ? 'primary' : ''  }}">
                            {{ $item->event }}
                        </p>
                    </td>
                    <td>{{ $item->created_at->format('d-m-y') }}</td>
                    <td>{{ $item->updated_at->format('d-m-y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $items->links('pagination::bootstrap-5') }}
    </div>
</div>