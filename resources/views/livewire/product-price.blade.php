<div class="card">
    <div class="card-header">
        <h5>Dados Gerais</h5>
        <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
        <x-form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-12 col-lg-2 pt-4 pt-lg-0">
                    <x-label for="Idade" /><em class="text-danger">*</em>
                    <select wire:model="age" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($prices as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-error field="age" class="is-invalid" />
                </div>
                <div class="col-12 col-lg-3 pt-4 pt-lg-0">
                    <x-label for="Valor" /><em class="text-danger">*</em>
                    <input wire:model="amount" type="tel" class="form-control amount" placeholder="R$ 0,00" value="{{ old('amount') }}" required />
                    <x-error field="amount" class="is-invalid" />
                </div>
                <div class="col-12 col-lg-3 pt-4 pt-lg-0">
                    <x-label for="Status" /><em class="text-danger">*</em>
                    <select wire:model="status" class="form-control">
                        <option value="">Selecione</option>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                    <x-error field="status" class="is-invalid" />
                </div>

                <div class="col-12 col-lg pt-4 pt-lg-0">
                    <button type="submit" class="btn btn-primary mt-lg-4">Cadastrar</button>
                </div>
            </div>
        </x-form>
    </div>
</div>
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
                    <th scope="col">Idade</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Status</th>
                    <th scope="col">Criado</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->type->name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>
                        <span class="badge rounded-pill badge-{{ $item->badgeColor() }}">
                            {{ $item->status == 1 ? 'Ativo' : 'Inativo' }}
                        </span>
                    </td>
                    <td>{{ $item->created_at->format('d-m-y') }}</td>
                    <td>
                        @livewire('delete', ['route' => route('dashboard.valores-passeios.destroy', $item->id),'text' => 'Excluir'],key($item->id))
                        {{-- <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Opções
                            </button>
                            <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
                                
                                <li class="d-flex dropdown-item">
                                    @livewire('delete', ['route' => route('dashboard.valores-passeios.destroy', $item),'text' => 'Excluir'],key($item->id))
                                </li>
                            </ul>
                        </div> --}}
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