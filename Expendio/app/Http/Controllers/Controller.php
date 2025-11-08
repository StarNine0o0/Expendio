<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Asume que tu Modelo se llama PRODUCTO
use App\Models\Sucursales; // Necesario para el filtro de sucursales

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener todas las sucursales para el menú de filtro
        $sucursales = Sucursales::all();

        // 2. Iniciar la consulta de productos
        $productos = Producto::with(['marca', 'categoria', 'producto_sucursales']);
        
        // 3. Aplicar Filtro de Búsqueda (por nombre o código de barra)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $productos->where('nombre', 'like', '%' . $search . '%')
                      ->orWhere('codigo_barra', 'like', '%' . $search . '%');
        }

        // 4. Aplicar Filtro por Sucursal
        if ($request->has('sucursal_id') && $request->sucursal_id != '') {
            $sucursalId = $request->sucursal_id;
            
            // Filtra solo los productos que tienen stock en la sucursal seleccionada
            $productos->whereHas('producto_sucursales', function ($query) use ($sucursalId) {
                $query->where('id_sucursal', $sucursalId);
            });
        }

        // 5. Ejecutar la consulta con paginación
        $productos = $productos->paginate(15); 

        // 6. Retornar la vista con los datos
        return view('inventario', [
            'productos' => $productos,
            'sucursales' => $sucursales,
            'selected_sucursal' => $request->sucursal_id
        ]);
    }
}