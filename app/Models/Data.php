<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Data extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'cpf',
        'rg',
        'phone',
        'fixo',
        'createtur',
        'company_phone',
        'company_fixo',
        'commission'
    ];

     /**
     * Get the type that owns the ProductPrice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'datable');
    }

    public function setData(&$data, $request)
    {
        $data->cnpj = $request['cnpj'];
        $data->cpf = $request['cpf'];
        $data->rg = $request['rg'];
        $data->phone = $request['phone'];
        $data->fixo = $request['fixo'];
        @$data->company_phone = $request['company_phone'];
        @$data->company_fixo = $request['company_fixo'];
        $data->createtur = $request['createtur'];
        @$data->commission = $request['commission'];
    }
}
