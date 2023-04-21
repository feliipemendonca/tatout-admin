<x-layout>
    <x-slot:title>{{ __('Tipos de Produtos') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Tipos de Produtos') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">Tipos de Produtos</li>
                            <li class="breadcrumb-item active">Listar</li>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <div class="bookmark">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard.tipo-produto.create') }}" class="btn btn-primary text-white">
                                        Novo Tipo
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:type-product />
        </div>
    </x-slot:content>
</x-layout>
