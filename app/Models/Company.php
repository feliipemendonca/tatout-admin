<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends BaseModel
{
    use HasFactory;

    protected $table = "companies";

    protected $fillable = [
        'name',
        'user_id',
        'status_id'
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
     * Get the getUser that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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

    /**
     * Get the data that owns the user
     *
     * @return MorphOne
     */
    public function data()
    {
        return $this->morphOne(Data::class, 'datable');
    }

    /**
     * Get the products that owns the User
     *
     * @return MorphMany
     */
    public function products()
    {
        return $this->morphMany(Product::class, 'productble');
    }
}
