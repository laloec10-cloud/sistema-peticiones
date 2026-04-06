<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Resultados de Exámenes</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* CONTENEDOR */
.container {
    width: 90%;
    max-width: 900px;
    margin: 40px auto;
}

/* TÍTULO */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1A3E5C;
}

/* TABLA */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

th {
    background: #1A3E5C;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

/* COLORES CALIFICACIÓN */
.aprobado {
    color: green;
    font-weight: bold;
}

.reprobado {
    color: red;
    font-weight: bold;
}

/* BOTÓN REGRESAR */
.regresar {
    margin-top: 15px;
    display: flex;
    justify-content: flex-end;
}

.regresar a {
    padding: 8px 15px;
    background: #1A3E5C;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}

.regresar a:hover {
    background: #16304a;
}
</style>
</head>

<body>

<div class="container">

<h2>Resultados de Exámenes</h2>

<table>
<thead>
<tr>
    <th>Módulo</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Calificación</th>
</tr>
</thead>

<tbody>
@forelse($resultados as $r)
<tr>
    <td>{{ $r->modulo }}</td>
    <td>{{ $r->fecha }}</td>
    <td>{{ $r->hora }}</td>
    <td>
        @if($r->calificacion !== null)
            @if($r->calificacion >= 6)
                <span class="aprobado">{{ $r->calificacion }}</span>
            @else
                <span class="reprobado">{{ $r->calificacion }}</span>
            @endif
        @else
            Pendiente
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="4">No hay resultados disponibles</td>
</tr>
@endforelse
</tbody>
</table>

<!-- BOTÓN -->
<div class="regresar">
    <a href="{{ route('alumno.dashboard') }}"> Regresar al menú</a>
</div>

</div>

</body>
</html>