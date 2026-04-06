<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return view('secretarias.alumnos.index', compact('alumnos'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'matricula_inca' => 'required|string|max:255|unique:alumnos,matricula_inca',
            'curp' => 'required|string|size:18|unique:alumnos,curp',
            'correo' => 'required|email|max:255|unique:alumnos,correo',
            'telefono' => 'nullable|string|max:20',
            'contraseña' => 'required|string|min:6',
        ]);

        // Guardar alumno
        Alumno::create([
            'nombre_completo' => $request->nombre_completo,
            'matricula_inca' => $request->matricula_inca,
            'curp' => strtoupper($request->curp), // GUARDA LA CURP
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'contraseña' => bcrypt($request->contraseña),
        ]);

        return redirect()->route('secretaria.alumnos.index')
            ->with('success', 'Alumno registrado correctamente');
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('secretarias.alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'matricula_inca' => 'required|string|max:255',
            'curp' => 'required|string|max:18',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $alumno->update([
            'nombre_completo' => $request->nombre_completo,
            'matricula_inca' => $request->matricula_inca,
            'curp' => $request->curp,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('secretaria.alumnos.index')
                ->with('success', 'Alumno actualizado correctamente');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('secretaria.alumnos.index')
                ->with('success', 'Alumno eliminado correctamente'); 
    }
}