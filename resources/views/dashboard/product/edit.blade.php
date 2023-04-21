<x-layout>
    <x-slot:title>{{ __('Passeios') }}</x-slot:title>
    <x-slot:content>
        <div class="container-fluid dashboard-default-sec">
            <div class="page-header pt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h3>{{ __('Passeio: ') }} {{ $item->name }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Início</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.passeios.index') }}">Passeios</a>
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
                <x-form action="{{ route('dashboard.passeios.update', $item->id) }}" has-files>
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                                <x-label for="Nome" /><em class="text-danger">*</em>
                                <x-input name="name" class="form-control" placeholder="Nome" value="{{ $item->name }}" required />
                                <x-error field="name" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-6 pt-4 pt-lg-0">
                                <x-label for="Tipo" /><em class="text-danger">*</em>
                                <select name="type_product_id" class="form-control" id="">
                                    <option value="">Selecione</option>
                                    @foreach ($type as $t)
                                        <option value="{{ $t->id }}" {{ $t->id == $item->type_product_id ? 'selected' : '' }}>{{ $t->name }}</option>
                                    @endforeach
                                </select>
                                <x-error field="type_product_id" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-6 pt-4">
                                <x-label for="A partir de:" /><em class="text-danger">*</em>
                                <x-input name="amount" type="tel" class="form-control amount" placeholder="R$ 0,00" value="{{ $item->amount }}" required />
                                <x-error field="amount" class="is-invalid" />
                            </div>
                            <div class="col-12 col-lg-6 pt-4">
                                <x-label for="Status" /><em class="text-danger">*</em>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Ativo</option>
                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inativo</option>
                                </select>
                                <x-error field="status" class="is-invalid" />
                            </div>
                            <div class="col-12 pt-4">
                                <x-label for="Descrição" /><em class="text-danger">*</em>
                                <x-textarea name="description" row="25" class="form-control">
                                    {{ $item->description }}
                                </x-textarea>
                                <x-error field="description" class="is-invalid" />
                            </div>
                            <div class="col-12 p-0">
                                <hr class="mt-5 w-100">
                            </div>
                            <div class="card-header p-2">
                                <h5>Imagens Cadastradas</h5>
                                <span>Clique no <i class="fa fa-trash text-danger"></i> para remover a imagem.</span>
                            </div>
                            <div class="col-12 pt-4">
                                <div class="gallery my-gallery card-body p-0">
                                    <div class="row">
                                        @foreach ($item->file as $file)
                                            <figure class="col-6 col-lg-3 d-flex position-relative flex-row-reverse file_{{ $file->id }}" itemprop="associatedMedia" itemscope="">
                                                <button class="btn btn-sm p-0 px-1 btn-danger text-white remove_file position-absolute" data-id="{{ $file->id }}" type="button">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <a href="{{ Storage::url($file->name) }}" itemprop="contentUrl" data-size="1600x950">
                                                    <img class="img-thumbnail" src="{{ Storage::url($file->name) }}" itemprop="thumbnail" alt="Image description">
                                                </a>
                                            </figure>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 p-0 pt-2">
                                <hr class="mt-5 w-100">
                            </div>
                            <div class="card-header p-2">
                                <h5>Cadastrar novas imagens</h5>
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
