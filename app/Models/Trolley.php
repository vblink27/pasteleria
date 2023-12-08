<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trolley extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'id_usuario',
        'id_product',
      
     ];
 
     public function usuario()
     {
         return $this->belongsTo(Usuario::class, 'id_usuario');
     }
     public function product()
     {
         return $this->belongsTo(Product::class, 'id_product');
     }
}
