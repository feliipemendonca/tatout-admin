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
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Guard</th>
                    <th scope="col">Criado</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->guard_name }}</td>
                    <td>{{ $item->created_at->format('d-m-y') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Opções
                            </button>
                            <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.roles.edit', $item->id) }}" title="Editar">
                                        Editar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.roles.show', $item->id) }}" title="Editar">
                                        Permissões
                                    </a>
                                </li>
                                <li class="d-flex dropdown-item">
                                    @livewire('delete', ['route' => route('dashboard.roles.destroy', $item),'text' => 'Excluir'],key($item->id))
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $items->links('pagination::bootstrap-5') }}
    </div>
</div>