<div class="col-12 col-lg-2 pt-4">
    <x-label for="Cep" /><em class="text-danger">*</em>
    <x-input name="zip" type="tel" class="form-control zip" placeholder="00.000-000"  value="{{ $zip ?? old('zip') }}" />
    <small><x-error field="zip" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-5 pt-4">
    <x-label for="Estado" /><em class="text-danger">*</em>
    <x-input name="state" type="text" class="form-control"  value="{{ $state ?? old('state') }}" />
    <small><x-error field="state" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-5 pt-4">
    <x-label for="Cidade" /><em class="text-danger">*</em>
    <x-input name="city" type="text" class="form-control"  value="{{ $city ?? old('city') }}" />
    <small><x-error field="city" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-5 pt-4">
    <x-label for="Endereço" /><em class="text-danger">*</em>
    <x-input name="address" type="text" class="form-control"  value="{{ $address ?? old('address') }}" />
    <small><x-error field="address" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-2 pt-4">
    <x-label for="Número" /><em class="text-danger">*</em>
    <x-input name="number" type="tel" class="form-control"  value="{{ $number ?? old('number') }}" />
    <small><x-error field="number" class="text-danger" /></small>
</div>
<div class="col-12 col-lg-5 pt-4">
    <x-label for="Bairro" /><em class="text-danger">*</em>
    <x-input name="district" type="text" class="form-control"  value="{{ $district ?? old('district') }}" />
    <small><x-error field="district" class="text-danger" /></small>
</div>
<div class="col-12 pt-4">
    <x-label for="Complemento" />
    <x-input name="complement" type="text" class="form-control" value="{{ $complement ?? old('complement') }}" />
    <small><x-error field="complement" class="text-danger" /></small>
</div>