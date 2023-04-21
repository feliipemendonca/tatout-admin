<x-layout>
    <x-slot:title>{{ __('Dashboard') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-12">
                        <h3>Painel de Controle</h3>
                    </div>
                </div>
            </div>
            @if (auth()->user()->getRole() == 'master' || auth()->user()->getRole() == 'admin')
                <livewire:reserve-card />
                <livewire:reserve />
            @endif
            
            
        </div>
    </x-slot:content>
</x-layout>
