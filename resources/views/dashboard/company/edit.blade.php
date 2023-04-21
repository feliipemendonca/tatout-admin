<x-layout>
    <x-slot:title>{{ __('Fornecedores') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Fornecedor: ') }}{{ $item->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.fornecedores.index') }}">Fornecedores</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $item->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Dados Gerais</h5>
                    <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                </div>
                <x-form method="post" action="{{ route('dashboard.fornecedores.update', $item) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <x-label for="Nome" /><em class="text-danger">*</em>
                                <x-input name="company" class="form-control" placeholder="Fornecedor" value="{{ $item->name }}" required />
                                <small><x-error field="company" class="text-danger" /></small>
                            </div>
                            <div class="col-12 col-lg-3">
                                <x-label for="CNPJ" /><em class="text-danger">*</em>
                                <x-input name="cnpj" type="tel" class="form-control cnpj" value="{{ $item->data?->cnpj }}" placeholder="00.000.000/0000-00" required />
                                <small><x-error field="cnpj" class="text-danger" /></small>
                            </div>
                            <div class="col-12 col-lg-5">
                                <x-label for="CadastraTur" /><em class="text-danger">*</em>
                                <x-input name="createtur" type="tel" class="form-control cnpj" value="{{ $item->data?->createtur }}" placeholder="00.000.000/0000-00" required />
                                <small><x-error field="createtur" class="text-danger" /></small>
                            </div>
                            <div class="col-12 col-lg-3 pt-4">
                                <x-label for="Celular" /><em class="text-danger">*</em>
                                <x-input name="company_phone" type="tel" class="form-control phone" placeholder="(00) 0 0000-0000" value="{{ old('company_phone') ?? $item->data?->company_phone }}" required />
                                <small><x-error field="company_phone" class="text-danger" /></small>
                            </div>
                            <div class="col-12 col-lg-3 pt-4">
                                <x-label for="Fixo" />
                                <x-input name="company_fixo" type="tel" class="form-control fixo" placeholder="(00) 0000-0000" value="{{ $item->data?->company_fixo ?? old('') }}" />
                                <small><x-error field="company_fixo" class="text-danger" /></small>
                            </div>

                            <div class="col-12 p-0">
                                <hr class="mt-5 w-100">
                            </div>
                            
                            <div class="card-header p-2">
                                <h5>Endereço</h5>
                                <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                            </div>
                            @if ($item->address == null)
                                <x-address />
                            @else
                                <x-address 
                                    :zip="$item->address->zip"
                                    :address="$item->address->address"
                                    :state="$item->address->state"
                                    :city="$item->address->city"
                                    :district="$item->address->district"
                                    :number="$item->address->number"
                                    :complement="$item->address->complement"
                                />
                            @endif

                            <div class="col-12 p-0">
                                <hr class="mt-5 w-100">
                            </div>
                            <div class="card-header p-2">
                                <h5>Informações de Acesso</h5>
                                <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                            </div>
                            @if ($item->getUser == null)
                                <x-user />
                            @else
                                <x-user 
                                    :name="$item->getUser->name"
                                    :cpf="$item->getUser->data?->cpf"
                                    :rg="$item->getUser->data?->rg"
                                    :email="$item->getUser->email"
                                    :phone="$item->getUser->data?->phone"
                                    :fixo="$item->getUser->data?->fixo"
                                />
                            @endif                            

                            <div class="col-12 col-lg-4 pt-4">
                                <x-label for="Status" /><em class="text-danger">*</em>
                                <select name="status_id" class="form-control" required>
                                    <option value="">Selecione</option>
                                    @foreach ($status as $statu)
                                        <option value="{{ $statu->id }}" {{ $item->status_id === $statu->id ? 'selected' : '' }}>{{ $statu->name }}</option>
                                    @endforeach
                                </select>
                                <small><x-error field="status_id" class="text-danger" /></small>
                            </div>  
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:history.back();" class="btn btn-danger">Voltar</a>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </x-slot:content>
    <x-slot:js>
        <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </x-slot:js>
</x-layout>
