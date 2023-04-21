<x-layout>
    <x-slot:title>{{ __('Vendedores') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Vendedores') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.vendedores.index') }}">Vendedores</a>
                            </li>
                            <li class="breadcrumb-item active">Novo Usuário</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Dados Gerais</h5>
                    <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                </div>
                <x-form action="{{ route('dashboard.vendedores.store') }}">
                    <input type="hidden" name="user_type" value="seller">
                    <div class="card-body">
                        <div class="row">

                            <x-user 
                                :company="$company" 
                            />
                            
                            <div class="col-12 p-0">
                                <hr class="mt-5 w-100">
                            </div>
                            
                            <div class="card-header p-2">
                                <h5>Endereço</h5>
                                <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                            </div>

                            <x-address />
                            <div class="col-12 col-lg-4 pt-4">
                                <x-label for="Status" /><em class="text-danger">*</em>
                                <select name="status_id" class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <small><x-error field="status_id" class="text-danger" /></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:history.back();" class="btn btn-danger">Voltar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
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
