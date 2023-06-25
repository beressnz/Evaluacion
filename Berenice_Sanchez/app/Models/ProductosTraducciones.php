<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosTraducciones extends Model
{
    protected $table = 'producto_traducciones';
    protected $fillable = ['producto_id','nombre','descripcion_corta','descripcion_larga','url','idioma'];
}
