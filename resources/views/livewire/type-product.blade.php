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
                    <th scope="col">Nome</th>
                    <th scope="col">Produtos</th>
                    <th scope="col">Status</th>
                    <th scope="col">Criado</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items->lazy() as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->products->count() }}</td>
                    <td>
                        <span class="badge rounded-pill badge-{{ $item->badgeColor() }}">
                            {{ $item->status == 1 ? 'Ativo' : 'Inativo' }}
                        </span>
                    </td>
                    <td>{{ $item->created_at->format('d-m-y') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Opções
                            </button>
                            <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.tipo-produto.edit', $item->id) }}" title="Editar">
                                        Editar
                                    </a>
                                </li>
                                <li class="d-flex dropdown-item">
                                    @livewire('delete', ['route' => route('dashboard.tipo-produto.destroy', $item),'text' => 'Excluir'],key($item->id))
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- <div class="card-footer">
        {{ $items->links('pagination::bootstrap-5') }}
    </div> --}}
</div>