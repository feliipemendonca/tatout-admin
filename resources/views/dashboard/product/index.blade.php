<x-layout>
    <x-slot:title>{{ __('Passeios') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Passeios') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">Passeios</li>
                            <li class="breadcrumb-item active">Listar</li>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <div class="bookmark">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard.passeios.create') }}" class="btn btn-primary text-white">
                                        Novo Passeio
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:product />
        </div>
    </x-slot:content>
</x-layout>
