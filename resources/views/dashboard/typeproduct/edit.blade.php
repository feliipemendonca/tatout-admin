<x-layout>
    <x-slot:title>{{ __('Tipos de Produto') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Tipo: ') }}{{ $item->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.tipo-produto.index') }}">Tipos de Produto</a>
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
                <x-form method="post" action="{{ route('dashboard.tipo-produto.update', $item) }}">
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <x-label for="Nome" /><em class="text-danger">*</em>
                                <x-input name="name" class="form-control" placeholder="Fornecedor" value="{{ $item->name }}" required />
                                <x-error field="name" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-6">
                                <x-label for="Status" /><em class="text-danger">*</em>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <x-error field="status" class="is-invalid" />
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
        <script>
            $(document).ready(_=> {
                $('.cnpj').mask('00.000.000/0000-00');
            });
        </script>
    </x-slot:js>
</x-layout>
