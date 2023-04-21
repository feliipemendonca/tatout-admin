<div class="col-12 col-lg-6">
    <x-label for="Nome" /><em class="text-danger">*</em>
    <x-input name="name" class="form-control" placeholder="Nome" value="{{ $name ?? old('name') }}" required/>
    <small><x-error field="name" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-3 pt-4 pt-lg-0">
    <x-label for="CPF" /><em class="text-danger">*</em>
    <x-input name="cpf" type="tel" class="form-control cpf" placeholder="000.000.000-00" value="{{ $cpf ?? old('cpf') }}" required />
    <small><x-error field="cpf" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-3 pt-4 pt-lg-0">
    <x-label for="RG" /><em class="text-danger">*</em>
    <x-input name="rg" type="tel" class="form-control rg" placeholder="000.000.000" value="{{ $rg ?? old('rg') }}" required/>
    <small><x-error field="rg" class="text-danger" /></small>
</div>
@if (auth()->user()->hasCompany)
    <input type="hidden" name="supplier_id" value="{{ auth()->user()->hasCompany->company_id }}">
@else
    @isset($company)
        <div class="col-12 col-lg-6 pt-4">
            <x-label for="Fornecedor" /><em class="text-danger">*</em>
            <select name="supplier_id" class="form-control" id="" required>
                <option value="">Selecione Fornecedor</option>
                @foreach ($company->lazy() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <small><x-error field="supplier_id" class="text-danger" /></small>
        </div>
    @endisset
    {{-- @if (!Route::is('dashboard.vendedores.create') && )
        <div class="col-12 col-lg-6 pt-4">
            <x-label for="Tipo de usuário" /><em class="text-danger">*</em>
            <select name="user_type" class="form-control" required>
                <option value="">Selecione</option>
                @if (auth()->user()->getRole() == "master")
                    <option value="master">Master</option>
                @endif
                
                <option value="admin">Administrador</option>
                <option value="seller">Vendedor</option>
            </select>
            <small><x-error field="user_type" class="text-danger" /></small>
        </div>
    @endif --}}
@endif

<div class="col-12 col-lg-6  pt-4">
    <x-label for="E-mail" /><em class="text-danger">*</em>
    <x-input name="email" class="form-control" placeholder="E-mail" value="{{ $email ?? old('email') }}" required/>
    <small><x-error field="email" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-{{ Route::is('dashboard.vendedores.edit') ? '6' : '3' }}  pt-4">
    <x-label for="Senha" />{!! !Route::is('dashboard.vendedores.edit') ? '<em class="text-danger">*</em>' : '' !!}
    <x-input name="password" type="text" class="form-control" placeholder="*************" />
    <small><x-error field="password" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-3 pt-4">
    <x-label for="Celular do usuário" /><em class="text-danger">*</em>
    <x-input name="phone" type="tel" class="form-control phone" placeholder="(00) 0 0000-0000" value="{{ $phone ?? old('phone') }}" required/>
    <small><x-error field="phone" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-3 pt-4">
    <x-label for="Fixo usuário" />
    <x-input name="fixo" type="tel" class="form-control fixo" placeholder="(00) 0000-0000" value="{{ $fixo ?? old('fixo') }}"  />
    <small><x-error field="fixo" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-3 pt-4">
    <x-label for="Commissão" />
    <x-input name="commission" type="tel" class="form-control digits" placeholder="10%" value="{{ $commission ?? old('commission') }}"  />
    <small><x-error field="commission" class="text-danger" /></small>
</div>