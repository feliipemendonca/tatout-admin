<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = "suppliers";

    protected $fillable = [
        'name',
        'cnpj',
        'status_id',
        'createtur'
    ];

    public function userBadgeColor()
    {
        $badgeColor = [
            1    => 'primary',
            2    => 'danger',
            3    => 'warning',
        ];

        return $badgeColor[$this->status_id ?? ''];
    }

    /**
     * The users that belong to the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the status that owns the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the address that owns the Supplier
     *
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
