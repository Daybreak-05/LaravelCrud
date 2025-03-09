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

public function owner() {
    return $this->belongsTo(User::class, 'user_id');
}

public function interestedUser() {
    return $this->belongsTo(User::class, 'interested_user_id');
}


}
?>