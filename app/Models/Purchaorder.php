<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricetotal',
        'status',
        'img_pago',
        'img_delivery',
        'address',
        'units',
        'id_cliente',
        'id_repartidor',
        'id_trolley',
        'id_usuario',
     ];
 
     public function usuario()
     {
         return $this->belongsTo(Usuario::class, 'id_usuario');
     }
     public function repartido()
     {
         return $this->belongsTo(Usuario::class, 'id_repartidor');
     }
     public function cliente()
     {
         return $this->belongsTo(Usuario::class, 'id_cliente');
     }
     public function trolley()
     {
         return $this->belongsTo(Trolley::class, 'id_trolley');
     }
}
