<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Calificaciones</title>
<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
}
h2 {
    text-align: center;
    margin-top: 40px;
    color: #1A3E5C;
}
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
}
th {
    background: #1A3E5C;
    color: white;
    padding: 10px;
    text-align: center;
}
td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}
input {
    width: 70px;
}
button {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background: #1A3E5C;
    color: white;
    border: none;
    cursor: pointer;
}
button:hover {
    background: #16324a;
}
a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #1A3E5C;
    text-decoration: none;
    font-weight: bold;
}
a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<h2>Editar Calificaciones</h2>

@if(session('success'))
    <div style="text-align:center; background:#d4edda; color:#155724; padding:10px; width:90%; margin:auto; border-radius:5px; margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('secretaria.calificaciones.guardar') }}">
@csrf

<table>
<tr>
<th>Alumno</th>
<th>Módulo</th>
<th>Fecha</th>
<th>Hora</th>
<th>Calificación</th>
</tr>

@forelse($examenes as $e)
<tr>
<td>{{ $e->alumno }}</td>
<td>{{ $e->modulo }}</td>
<td>{{ $e->fecha }}</td>
<td>{{ $e->hora }}</td>
<td>
<input type="number" name="calificaciones[{{ $e->id }}]" min="0" max="10" value="{{ $e->calificacion ?? '' }}">
</td>
</tr>
@empty
<tr>
<td colspan="5">No hay exámenes solicitados</td>
</tr>
@endforelse

</table>

<button type="submit">Guardar Calificaciones</button>
</form>

<a href="{{ route('secretaria.calificaciones') }}">Volver a Calificaciones Pendientes</a>

</body>
</html>