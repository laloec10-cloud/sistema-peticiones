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
}

td {
    padding: 14px;
    border-bottom: 1px solid #eaeaea;
    font-size: 14px;
    color: #333;
}

tbody tr:hover {
    background-color: #f2f7fb;
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
}

.btn-delete {
    background-color: #c53030;
    color: white;
    padding: 7px 14px;
    border-radius: 6px;
    border: none;
    font-size: 12px;
    cursor: pointer;
}

.no-data {
    margin-top: 20px;
    font-style: italic;
    color: #666;
    text-align: center;
}

/*  BOTÓN REGRESAR */
.regresar {
    max-width: 1200px;
    margin: 15px auto;
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
    background: #16314a;
}
</style>
</head>

<body>

<h1>Lista de Alumnos</h1>

<div class="table-container">

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($alumnos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Matrícula</th>
                    <th>CURP</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
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

<!--  BOTÓN ABAJO DERECHA -->
<div class="regresar">
    <a href="{{ route('secretaria.dashboard') }}"> Regresar al menú</a>
</div>

</body>
</html>