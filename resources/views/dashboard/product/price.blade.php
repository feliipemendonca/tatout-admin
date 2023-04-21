<x-layout>
    <x-slot:title>{{ __('Valores de Passeios') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Valores do passeio: ') }} {{ $item->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                               Valores do passeio
                            </li>
                            <li class="breadcrumb-item active">Passeio: {{ $item->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <livewire:product-price :product="$item" />
        </div>
    </x-slot:content>
    <x-slot:js>
        <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </x-slot:js>
</x-layout>
