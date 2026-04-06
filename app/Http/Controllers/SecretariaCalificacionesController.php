<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecretariaCalificacionesController extends Controller
{
    // Mostrar la tabla de calificaciones
    public function index()
    {
        $examenes = DB::table('solicitudes_examen')
            ->join('alumnos', 'solicitudes_examen.alumno_id', '=', 'alumnos.id')
            ->join('calendario_examenes', 'solicitudes_examen.calendario_id', '=', 'calendario_examenes.id')
            ->leftJoin('calificaciones', 'solicitudes_examen.id', '=', 'calificaciones.solicitud_id')
            ->select(
                'solicitudes_examen.id',
                'alumnos.nombre_completo as alumno',
                'calendario_examenes.modulo',
                'calendario_examenes.fecha',
                'calendario_examenes.hora',
                'calificaciones.calificacion'
            )
            ->get();

        return view('secretarias.calificaciones', compact('examenes'));
    }

    // Guardar todas las calificaciones (botón global)
    public function guardar(Request $request)
    {
        if ($request->has('calificaciones')) {
            foreach ($request->calificaciones as $id => $calificacion) {
                // Revisar si ya existe
                $existe = DB::table('calificaciones')->where('solicitud_id', $id)->first();

                if ($existe) {
                    DB::table('calificaciones')
                        ->where('solicitud_id', $id)
                        ->update(['calificacion' => $calificacion]);
                } else {
                    DB::table('calificaciones')->insert([
                        'solicitud_id' => $id,
                        'calificacion' => $calificacion
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Calificaciones guardadas correctamente.');
    }

    // Editar una sola calificación (botón individual)
    public function editar(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:10'
        ]);

        $calificacion = $request->input('calificacion');

        // Revisar si ya existe
        $existe = DB::table('calificaciones')->where('solicitud_id', $id)->first();

        if ($existe) {
            DB::table('calificaciones')
                ->where('solicitud_id', $id)
                ->update(['calificacion' => $calificacion]);
        } else {
            DB::table('calificaciones')->insert([
                'solicitud_id' => $id,
                'calificacion' => $calificacion
            ]);
        }

        return redirect()->back()->with('success', 'Calificación actualizada correctamente.');
    }
}