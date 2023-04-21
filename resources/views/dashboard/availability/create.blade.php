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
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.passeios.agenda.index',['passeio' => $item->id]) }}">Agenda</a>
                            </li>
                            <li class="breadcrumb-item active">Nova Agenda</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Dados Gerais</h5>
                    <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                </div>
                <x-form action="{{ route('dashboard.passeios.agenda.store',['passeio' => $item->id]) }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <x-label for="Dia" /><em class="text-danger">*</em>
                                <input class="datepicker-here form-control digits" type="text" data-multiple-dates="30" data-multiple-dates-separator=", " name="date" data-language="en" value="{{ old('date') }}">
                                <x-error field="date" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-4 pt-3 pt-lg-0">
                                <x-label for="Horário" /><em class="text-danger">*</em>
                                <input name="time" type="tel" id="single-input" class="form-control time" value="{{ old('time') }}" required >
                                <x-error field="hour" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-4 pt-3 pt-lg-0">
                                <x-label for="Vagas" /><em class="text-danger">*</em>
                                <x-input name="quantity" type="tel" class="form-control" placeholder="Vagas" value="{{ old('quantity') }}" required />
                                <x-error field="quantity" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-4 pt-3">
                                <x-label for="Público" /><em class="text-danger">*</em>
                                <select name="type_price_id" class="form-control type_price_id" data-id="{{ $item->id }}">
                                    <option value="">Selecione</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('type_price_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="status" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-4 pt-3">
                                <x-label for="Valor" /><em class="text-danger">*</em>
                                <input name="amount" type="tel" class="form-control amount" placeholder="R$ 0,00" value="{{ old('amount') }}" required >
                                <x-error field="amount" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-4 pt-3">
                                <x-label for="Status" /><em class="text-danger">*</em>
                                <select name="status_id" class="form-control">
                                    @foreach ($status as $statu)
                                        <option value="{{ $statu->id }}" {{ $item->status_id == old('status_id') ? 'selected' : '' }}>{{ $statu->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="status_id" class="is-invalid" />
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
        {{-- Clock Picker --}}
        <script src="{{ asset('assets/js/time-picker/jquery-clockpicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/time-picker/highlight.min.js') }}"></script>
        <script src="{{ asset('assets/js/time-picker/clockpicker.js') }}"></script>
        {{-- end Clock Picker --}}

        {{-- Data Picker --}}
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.pt-br.js') }}"></script>
        <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
        {{-- end Data --}}

        <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </x-slot:js>
    <x-slot:css>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/timepicker.css') }}">
    </x-slot:css>
</x-layout>
