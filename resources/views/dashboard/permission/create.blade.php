<x-layout>
    <x-slot:title>{{ __('Permissões') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Permissões') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.permission.index') }}">Permissões</a>
                            </li>
                            <li class="breadcrumb-item active">Nova permissão</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Dados Gerais</h5>
                    <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                </div>
                <x-form action="{{ route('dashboard.permission.store') }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <x-label for="Nome" /><em class="text-danger">*</em>
                                <x-input name="name" class="form-control" placeholder="Nome" required />
                                <x-error field="name" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-6">
                                <x-label for="Guarda" /><em class="text-danger">*</em>
                                <select name="guard_name" class="form-control">
                                    @foreach ($guard as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="guard_name" class="is-invalid" />
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
</x-layout>
