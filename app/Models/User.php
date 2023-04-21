<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Permission;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, Auditable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        if ($password !== null & $password !== "")
            $this->attributes['password'] = bcrypt($password);
    }
    

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class,'id')->select('name');
    }

   
    public function type()
    {
        $type = str_replace('["', '', str_replace('"]', '',$this->getRoleNames()));
        switch ($type):
            case 'master':
                return "Master";
                break;

            case 'company':
                return "Fornecedor";
                break;

            case 'admin':
                return "Administrador";
                break;

            case 'seller':
                return "Vendedor";
                break;
            
            default:
                return "";         
                break;

        endswitch;   
    }

    public function getRole()
    {
        return str_replace('["', '', str_replace('"]', '',$this->getRoleNames()));
    }

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
     * The suppliers that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function company(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Get all of the hasCompany for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hasCompany(): HasOne
    {
        return $this->hasOne(CompanyUser::class,'user_id');
    }

    /**
     * Get the address that owns the User
     *
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
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
     * Get the data that owns the user
     *
     * @return MorphOne
     */
    public function data()
    {
        return $this->morphOne(Data::class, 'datable');
    }

    public function setData(&$model, $request) 
    {
        // dd($request);
        $model->name = $request['name'];
        $model->email = $request['email'];
        $request['password'] ? $model->password = $request['password'] : '';
        // $model->cpf = $request['cpf'];
        // $model->rg = $request['rg'];
        $model->status_id = $request['status_id'];
    }
}
