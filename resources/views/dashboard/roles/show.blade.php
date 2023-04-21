<x-layout>
    <x-slot:title>{{ __('Nídel de Acesso') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Nídel de Acesso: ') }}{{ $item->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.roles.index') }}">Nídel de Acesso</a>
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
                <x-form method="post" action="{{ route('dashboard.roles.update', $item) }}">
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="form-check">
                                        <input class="form-check-input" name="permission[]" {{ in_array($permission->name, $array) ? 'checked' : '' }} type="checkbox" value="{{ $permission->id }}" id="flexCheckIndeterminate">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
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
</x-layout>
