<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Secretaria; // asegúrate de importar el modelo

class SecretariaController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('secretarias.dashboard');
    }

    // Lista de secretarias (opcional)
    public function index()
    {
        $secretarias = Secretaria::all(); 
        return view('secretarias.index', compact('secretarias'));
    }

    // Vista del formulario de registro
    public function create()
    {
        return view('secretarias.register'); 
    }

    // <-- Aquí va tu método store corregido -->
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'usuario' => 'required|string|max:50|unique:secretarias,usuario',
            'correo' => 'required|email|unique:secretarias,correo',
            'telefono' => 'required|string|max:20',
            'contraseña' => 'required|string|min:6',
        ]);

        // Guardar secretaria
        Secretaria::create([
            'nombre_completo' => $request->nombre_completo,
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contraseña' => bcrypt($request->contraseña),
        ]);

        return redirect()->route('secretaria.dashboard')
            ->with('success', 'Secretaria registrada correctamente.');
    }

    // Otros métodos opcionales (show, destroy, etc.)
}