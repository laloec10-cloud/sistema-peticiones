<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarioExamen;
use App\Models\SolicitudExamen;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SolicitudExamenController extends Controller
{
    public function index()
    {
        $modulos = CalendarioExamen::select('clave','modulo')
            ->groupBy('clave','modulo')
            ->orderBy('clave')
            ->get();

        return view('alumnos.solicitar_examen', compact('modulos'));
    }

    // Fechas filtradas por módulo + etapa
    public function fechasFiltradas($clave, $etapa)
    {
        $fechas = CalendarioExamen::where('clave', $clave)
            ->where('etapa', $etapa)
            ->whereDate('fecha', '>=', now())
            ->orderBy('fecha', 'asc')
            ->get(['id','fecha','hora']);

        // Formatear fecha
        $fechas = $fechas->map(function($f){
            $f->fecha_formateada = Carbon::parse($f->fecha)->format('d/m/Y');
            return $f;
        });

        return response()->json($fechas);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'fecha_id' => 'required|exists:calendario_examenes,id'
        ]);

        if (!Session::has('alumno_id')) {
            return redirect()->route('alumno.login')
                ->with('error', 'Debes iniciar sesión');
        }

        $fecha = CalendarioExamen::findOrFail($request->fecha_id);

        SolicitudExamen::create([
            'alumno_id' => Session::get('alumno_id'),
            'calendario_id' => $fecha->id,
            'fecha' => $fecha->fecha,
            'hora' => $fecha->hora
        ]);

        return redirect()->route('alumno.dashboard')
            ->with('success','Examen agendado correctamente');
    }

    public function misExamenes()
    {
        if (!Session::has('alumno_id')) {
            return redirect()->route('alumno.login');
        }

        $examenes = SolicitudExamen::where('alumno_id', Session::get('alumno_id'))
                    ->orderBy('fecha','asc')
                    ->get();

        return view('alumnos.mis_examenes', compact('examenes'));
    }

    public function resultados()
    {
        if (!Session::has('alumno_id')) {
            return redirect()->route('alumno.login');
        }

        $resultados = DB::table('solicitudes_examen')
            ->join('calendario_examenes', 'solicitudes_examen.calendario_id', '=', 'calendario_examenes.id')
            ->leftJoin('calificaciones', 'solicitudes_examen.id', '=', 'calificaciones.solicitud_id')
            ->where('solicitudes_examen.alumno_id', Session::get('alumno_id'))
            ->select(
                'calendario_examenes.modulo',
                'solicitudes_examen.fecha',
                'solicitudes_examen.hora',
                'calificaciones.calificacion'
            )
            ->orderBy('solicitudes_examen.fecha','asc')
            ->get();

        return view('alumnos.resultados_examenes', compact('resultados'));
    }
}