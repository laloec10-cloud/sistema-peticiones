<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SecretariaAuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('secretarias.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        $secretaria = Secretaria::where('usuario', $request->usuario)->first();

        if ($secretaria && Hash::check($request->contraseña, $secretaria->contraseña)) {

            Session::put('secretaria_id', $secretaria->id);

            return redirect()->route('secretaria.dashboard');
        }

        return back()->withErrors([
            'usuario' => 'Usuario o contraseña incorrectos'
        ]);
    }

    // Dashboard de secretaria
    public function dashboard()
    {
        if (!Session::has('secretaria_id')) {
            return redirect()->route('secretaria.login');
        }

        $secretaria = Secretaria::find(Session::get('secretaria_id'));
        return view('secretarias.dashboard', compact('secretaria'));
    }

    // Cerrar sesión
    public function logout()
    {
        Session::forget('secretaria_id');
        return redirect()->route('secretaria.login');
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('secretarias.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'usuario' => 'required|string|max:100|unique:secretarias,usuario',
            'correo' => 'required|email|unique:secretarias,correo',
            'telefono' => 'nullable|digits:10',
            'contraseña' => 'required|string|min:6',
        ]);

        Secretaria::create([
            'nombre_completo' => $request->nombre_completo,
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contraseña' => Hash::make($request->contraseña),
        ]);

        return redirect()->route('secretaria.login')
            ->with('success', 'Registro exitoso. Ingresa tus datos.');
    }
}