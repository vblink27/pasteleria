<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
       'nameproduct',
       'description',
       'stock',
       'imgproduct',
       'price',
       'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
    public function trolley()
    {
        return $this->hasMany(Trolley::class, 'id_product');
    }
}
