<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    //indica a que tabla va referenciado
    protected $table = 'productos';
    protected $fillable = ['sku','precioDolares','precioPesos','puntos','activo','eliminado'];
    
}
