<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-4 col-lg-3">
                <h5>Ultimas reservas</h5>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group form-control-search">
                    <select wire:model="companySearch" class="form-control" id="">
                        <option>Fornecedor</option>
                        @foreach ($company as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group form-control-search">
                    <select wire:model="userSearch" class="form-control" id="">
                        <option>Vendedor</option>
                        @foreach ($user as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="user-status table-responsive">
            <table class="table table-hover table-bordernone">
                <thead>
                    <tr>
                        <th scope="col">Reserva</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Status</th>
                        <th scope="col">Fornecedor</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $i => $item)
                    {{-- {{ dd($item->user) }} --}}
                        <tr>
                            <td style="min-width: 50px">
                                <strong>#{{ $item->id }}</strong>
                            </td>
                            <td>
                                <div class="media">
                                    <div class="media-body ms-0">
                                        <span>{{ $item->product?->name }}</span>
                                        <p>
                                            <strong>Data</strong>: {{ $item->date }}     
                                            <strong>Horário</strong>: {{ $item->hour }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="badge rounded-pill shadow-none pill-badge-{{  $i % 2 == 0 ? 'primary' : 'danger' }}">
                                {{  $i % 2 == 0 ? 'Confirmado' : 'Cancelado' }}
                                </p>
                            </td>
                            <td>
                                {{ $item->product?->productble?->name }}
                            </td>
                            <td>
                                {{ $item->user->name }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Opções
                                    </button>
                                    <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item" href="#" title="Ver">
                                                Ver
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" title="Editar">
                                                Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#" title="Editar">
                                                Arquivar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    