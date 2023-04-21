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
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.passeios.index') }}">Passeios</a>
                            </li>
                            <li class="breadcrumb-item active">Novo Passeio</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Dados Gerais</h5>
                    <span>Todos os campos com <em class="text-danger">*</em> são obrigatórios.</span>
                </div>
                <x-form action="{{ route('dashboard.passeios.store') }}" has-files>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                                        <x-label for="Nome" /><em class="text-danger">*</em>
                                        <x-input name="name" class="form-control" placeholder="Nome" required />
                                        <x-error field="name" class="is-invalid" />
                                    </div>
                                    <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                                        <x-label for="Tipo" /><em class="text-danger">*</em>
                                        <select name="type_product_id" class="form-control" id="">
                                            <option value="">Selecione</option>
                                            @foreach ($type as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == old('type_product_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-error field="type_product_id" class="is-invalid" />
                                    </div>
                                    @can('product.create', auth()->user())
                                        <div class="col-12 col-lg-6 pt-4 pt-lg-4">
                                            <x-label for="Forncedor" /><em class="text-danger">*</em>
                                            <select name="company_id" class="form-control js-example-basic-single" id="">
                                                @if (auth()->user()->hasCompany?->company?->id)
                                                    <option value="{{ auth()->user()->hasCompany?->company?->id }}" selected>{{ auth()->user()->hasCompany?->company?->name }}</option>
                                                @else
                                                    <option value="">Selecione</option>
                                                    @foreach ($companies as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == old('company_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <x-error field="company_id" class="is-invalid" />
                                        </div>
                                    @endcan
                                    <div class="col-12 col-lg-6 pt-4">
                                        <x-label for="A partir de:" /><em class="text-danger">*</em>
                                        <x-input name="amount" type="tel" class="form-control amount" placeholder="R$ 0,00" value="{{ old('amount') }}" required />
                                        <x-error field="amount" class="is-invalid" />
                                    </div>
                                    <div class="col-12 col-lg-6 pt-4">
                                        <x-label for="Status" /><em class="text-danger">*</em>
                                        <select name="status" class="form-control">
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        </select>
                                        <x-error field="status" class="is-invalid" />
                                    </div>
                                    <div class="col-12 pt-4">
                                        <x-label for="Descrição" /><em class="text-danger">*</em>
                                        <x-textarea name="description" row="25" class="form-control">
                                            {{ old('description') }}
                                        </x-textarea>
                                        <x-error field="description" class="is-invalid" />
                                    </div>

                                    {{-- <div class="col-12 p-0 pt-2">
                                        <hr class="mt-5 w-100">
                                    </div>
                                    <div class="card-header p-2">
                                        <h5>Valores</h5>
                                        <span>Clique aqui <i class="fa fa-plus text-primary add_file cursor-pointer" data-selector=".paster"></i> para adicionar outro campo para cadastar outros valores.</span>
                                    </div>
                                    <div class="col-12">                                
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-1">
                                                <input type="text" class="form-control" placeholder="City" aria-label="City">
                                            </div>
                                            <div class="col-12 col-lg-2">
                                                <input type="text" class="form-control" placeholder="State" aria-label="State">
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <input type="text" class="form-control" placeholder="Zip" aria-label="Zip">
                                            </div>
                                        </div>
                                        <hr>
                                    </div> --}}

                                    <div class="col-12 p-0 pt-2">
                                        <hr class="mt-5 w-100">
                                    </div>
                                    <div class="card-header p-2">
                                        <h5>Cadastrar imagens</h5>
                                        <span>Clique aqui <i class="fa fa-plus text-primary add_file cursor-pointer" data-selector=".paster"></i> para adicionar outro campo para cadastar imagem.</span>
                                    </div>
                                    <div class="col-12">                                
                                        <div class="row pt-2 paster">
                                            <div class="col-6 col-lg-3 pt-2 pt-lg-4 d-flex position-relative flex-row-reverse">
                                                {{-- <i class="fa fa-trash position-absolute text-danger"></i> --}}
                                                <input type="file" name="file[]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </x-slot:js>
</x-layout>
