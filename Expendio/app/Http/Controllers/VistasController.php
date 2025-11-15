<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VistasController extends Controller
{
    public function returnVistaLogin(){ //hay que agregar public pa que se vea alv 
        return view('login');
    }

    public function returnVistaMenu(){
        return view('menu');
    }
    public function returnVistaAlmacen(){
        return view('almacen');
    }


}
