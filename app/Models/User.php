<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Un usuario tiene un rol
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Un usuario puede tener varios productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorite_product');
    }

    // app/Models/User.php

    public function favorites()
    {
        // Relación many-to-many con productos (relación que asume que existe la tabla pivote 'favorites')
        return $this->belongsToMany(Product::class, 'favorites', 'user_id', 'product_id');
    }

}
