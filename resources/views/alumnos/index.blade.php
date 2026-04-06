<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Alumnos</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e9edf2, #cfd8e4);
    padding: 40px;
}

h1 {
    color: #1A3E5C;
    margin-bottom: 25px;
    font-size: 28px;
    text-align: center;
}

.table-container {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    max-width: 1200px;
    margin: auto;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-weight: 600;
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 8px;
}

thead {
    background: linear-gradient(90deg, #1A3E5C, #16314a);
    color: #ffffff;
}

th {
    padding: 15px;
    text-align: left;
    font-size: 14px;
    letter-spacing: 0.5px;
}

td {
    padding: 14px;
    border-bottom: 1px solid #eaeaea;
    font-size: 14px;
    color: #333;
}

tbody tr {
    transition: background 0.3s ease;
}

tbody tr:hover {
    background-color: #f2f7fb;
}

.badge-si {
    color: #155724;
    background-color: #d4edda;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 12px;
}

.badge-no {
    color: #721c24;
    background-color: #f8d7da;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 12px;
}

.actions {
    display: flex;
    gap: 8px;
}

.btn-edit {
    background-color: #1A3E5C;
    color: white;
    padding: 7px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-edit:hover {
    background-color: #16314a;
    transform: translateY(-2px);
}

.btn-delete {
    background-color: #c53030;
    color: white;
    padding: 7px 14px;
    border-radius: 6px;
    border: none;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background-color: #9b2c2c;
    transform: translateY(-2px);
}

.no-data {
    margin-top: 20px;
    font-style: italic;
    color: #666;
    text-align: center;
}
</style>
</head>

<body>

<h1>Lista de Alumnos</h1>

<div class="table-container">

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla de alumnos --}}
    @if($alumnos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Matrícula</th>
                    <th>CURP</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Examen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->nombre_completo }}</td>
                    <td>{{ $alumno->matricula_inca }}</td>
                    <td>{{ $alumno->curp }}</td>
                    <td>{{ $alumno->correo }}</td>
                    <td>{{ $alumno->telefono }}</td>
                    <td>
                        @if($alumno->solicitudesExamen && $alumno->solicitudesExamen->count() > 0)
                            <span class="badge-si">Sí</span>
                        @else
                            <span class="badge-no">No</span>
                        @endif
                    </td>
                    <td class="actions">
                        <a href="{{ route('secretaria.alumnos.edit', $alumno->id) }}" class="btn-edit">Editar</a>

                        <form action="{{ route('secretaria.alumnos.destroy', $alumno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este alumno?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">No hay alumnos registrados todavía.</p>
    @endif

</div>

</body>
</html>