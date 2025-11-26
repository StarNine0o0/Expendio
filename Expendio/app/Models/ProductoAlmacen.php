<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoAlmacen extends Model
{
    use HasFactory;
    protected $table = 'producto_almacen';
    protected $primaryKey = 'id_producto_surcursal';
    public $timestamps = false;

    protected $fillable = [
        'id_producto_surcursal', 'id_producto', 'id_sucursal', 'stock_actual', 'ubicacion', 'estado'
    ];

    // Relaciones

    /** Relación con la tabla PRODUCTO (pertenece a) */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    /** Relación con la tabla SUCURSAL (pertenece a) */
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id_sucursal');
    }
}
