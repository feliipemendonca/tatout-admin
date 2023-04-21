<x-layout>
    <x-slot:title>{{ __('Agenda - '. $item->name) }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Agenda: '. $item->name) }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">Agenda</li>
                            <li class="breadcrumb-item active">{{ $item->name }}</li>
                        </ol>
                    </div>
                    <div class="col-lg-6">
                        <div class="bookmark">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard.agenda.create') }}" class="btn btn-primary text-white">
                                        Nova Agenda
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <livewire:availability :product="$item" />
        </div>
    </x-slot:content>
</x-layout>
