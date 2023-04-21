<x-layout>
    <x-slot:title>{{ __('Logs') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>Logs</h3>
                    </div>
                </div>
            </div>
            <livewire:logs />
        </div>
    </x-slot:content>
</x-layout>
