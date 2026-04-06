<?php

namespace App\Http\Controllers;

use App\Models\ExamenDisponible;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function index()
    {
        $examenes = ExamenDisponible::all();
        return view('examenes.index', compact('examenes'));
    }

    public function create()
    {
        return view('examenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_examen' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'duracion_minutos' => 'nullable|integer',
            'fecha_disponible' => 'required|date'
        ]);

        ExamenDisponible::create($request->all());

        return redirect()->route('examenes.index')->with('success', 'Examen creado correctamente');
    }
}
