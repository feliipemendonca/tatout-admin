<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends BaseModel
{
    use HasFactory;

     protected $table = "addresses";

    protected $fillable = [
        'zip',
        'address',
        'complement',
        'number',
        'district',
        'city',
        'state'
    ];

    /**
     * The suppliers that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class);
    }

    /**
     * The users that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function setData(&$address, $request)
    {
        $address->zip = $request['zip'];
        $address->address = $request['address'];
        $address->complement = $request['complement'];
        $address->number = $request['number'];
        $address->district = $request['district'];
        $address->city = $request['city'];
        $address->state = $request['state'];
    }

}
