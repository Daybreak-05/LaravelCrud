<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'image', 
    ];


public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorite_product');
}

public function comments() {
    return $this->hasMany(Comment::class);
}


}
?>