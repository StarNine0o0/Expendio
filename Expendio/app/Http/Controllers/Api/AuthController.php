<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona; // Necesario si quieres crear el perfil asociado
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //REGISTRAR USUARIO (POST /api/register)
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:50|unique:usuarios,nombre_usuario',
            'email'          => 'required|string|email|max:100|unique:usuarios,email',
            'contrasena'     => 'required|string|min:8',
            'id_rol'         => 'required|integer|exists:roles,id_rol',
            'nombre'         => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'tipo_persona'   => 'required|in:trabajador,cliente',
        ]);

        // Crear USUARIOS
        $user = User::create([
            'nombre_usuario' => $validated['nombre_usuario'],
            'email'          => $validated['email'],
            'contrasena'     => Hash::make($validated['contrasena']),
            'id_rol'         => $validated['id_rol'],
        ]);
        
        // Crear PERSONAS
        Persona::create([
            'nombre'           => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'tipo_persona'     => $validated['tipo_persona'],
            'id_usuario'       => $user->id_usuario, // Enlaza el ID de login
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Usuario registrado correctamente',
            'user_id' => $user->id_usuario,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    //INICIAR SESIÓN (POST /api/login)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nombre_usuario' => 'required|string',
            'contrasena'     => 'required|string',
        ]);

        //Buscar usuario
        $user = User::where('nombre_usuario', $credentials['nombre_usuario'])->first();
        
        //  Verificar contraseña
        if(!$user || !Hash::check($credentials['contrasena'], $user->contrasena)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        //Limpiar tokens viejos y emitir nuevo
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    //CERRAR SESIÓN (POST /api/logout)
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cierre de sesión exitoso',
        ]);
    }
}