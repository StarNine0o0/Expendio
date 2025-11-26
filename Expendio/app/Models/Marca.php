<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    // Configuración de tabla y claves
    protected $table = 'marca';
    protected $primaryKey = 'id_marca';
    public $timestamps = false; // Tu tabla no usa created_at/updated_at

    protected $fillable = ['nombre','estado'];


}
