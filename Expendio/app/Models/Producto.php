<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Configuración de tabla y claves
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false; // Tu tabla no usa created_at/updated_at

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre', 'stock', 'fecha_ingreso', 'codigo_barra', 
        'costo_inventario', 'precio_unitario', 'estado', 'stock_minimo', 
        'stock_actual', 'stock_maximo', 'presentacion', 'tipo_envase', 
        'id_categoria', 'id_marca'
    ];

    // Definición de Relaciones (CRUCIALES para el InventarioController)

    /** * Relación con la tabla MARCAS (pertenece a)*/
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    /**Relación con la tabla CATEGORIAS (pertenece a)*/
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    /**Relación con la tabla PRODUCTO_ALMACEN (tiene muchos stocks)*/
    public function productoAlmacen()
    {
        // Un producto tiene muchos registros de stock en almacén (uno por sucursal)
        return $this->hasMany(ProductoAlmacen::class, 'id_producto', 'id_producto');
    }
}