<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    
    protected $table = 'sucursal';
    protected $primaryKey = 'id_sucursal';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'codigo_sucursal', 'direccion', 'colonia', 'ciudad', 'codigo_postal', 'telefono', 'correo', 'encargado'
    ];
}
