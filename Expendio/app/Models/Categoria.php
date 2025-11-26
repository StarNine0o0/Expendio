<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    // Configuración de tabla y claves
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    

    protected $fillable = ['estado','tipo','codigo','imagen_producto'];
}
