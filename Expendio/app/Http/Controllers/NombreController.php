<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NombreController extends Controller
{
    function returnVistaLogin(){
        return view('login');
    }
}
