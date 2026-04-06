<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AlumnoAuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('alumnos.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        // Buscar alumno por correo o matrícula
        $alumno = Alumno::where('correo', $request->identificador)
                        ->orWhere('matricula_inca', $request->identificador)
                        ->first();

        if ($alumno && Hash::check($request->contraseña, $alumno->contraseña)) {
            Session::put('alumno_id', $alumno->id);
            return redirect()->route('alumno.dashboard');
        }

        return back()->withErrors(['identificador' => 'Credenciales incorrectas']);
    }

    // Dashboard de alumno
    public function dashboard()
    {
        if (!Session::has('alumno_id')) {
            return redirect()->route('alumno.login');
        }

        $alumno = Alumno::find(Session::get('alumno_id'));
        return view('alumnos.dashboard', compact('alumno'));
    }

    // Cerrar sesión
    public function logout()
    {
        Session::forget('alumno_id');
        return redirect()->route('alumno.login');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('alumnos.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        // Validación
        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'matricula_inca'  => 'required|string|max:6|unique:alumnos,matricula_inca',
            'curp'            => 'required|string|size:18|unique:alumnos,curp',
            'correo'          => 'required|email|unique:alumnos,correo',
            'telefono'        => 'nullable|digits:10',
            'contraseña'      => 'required|string|min:6',
        ]);

        // Guardar alumno
        Alumno::create([
            'nombre_completo' => $request->nombre_completo,
            'matricula_inca'  => $request->matricula_inca,
            'curp'            => strtoupper($request->curp), // GUARDA CURP EN MAYÚSCULAS
            'correo'          => $request->correo,
            'telefono'        => $request->telefono,
            'contraseña'      => bcrypt($request->contraseña),
        ]);

        return redirect()->route('alumno.login')->with('success', 'Registro exitoso. Ingresa tus datos.');
    }
}