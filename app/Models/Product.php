<?php 
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'image',  // Asegúrate de incluir 'image'
    ];


public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorite_product');
}

}
?>