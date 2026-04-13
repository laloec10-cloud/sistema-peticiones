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
    background: #1A3E5C;
    color: white;
}

th {
    padding: 12px;
    text-align: left;
}

td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

tbody tr:hover {
    background: #f2f7fb;
}

.actions a,
.actions button {
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    color: white;
}

.actions a {
    background: #1A3E5C;
}

.actions button {
    background: #c53030;
}

/* 🔎 BUSCADOR estilo igual a calificaciones */
.buscador {
    width: 90%;
    margin: 20px auto;
    text-align: right;
}

.buscador input {
    padding: 8px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* 🔙 botón regresar */
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
}
</style>
</head>

<body>

<h1>Lista de Alumnos</h1>

<!-- 🔎 BUSCADOR -->
<div class="buscador">
    <input type="text" id="buscar" placeholder="Buscar por nombre o matrícula...">
</div>

<div class="table-container">

@if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

@if($alumnos->count() > 0)

<table id="tabla">
    <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Matrícula</th>
            <th>CURP</th>
            <th>Correo</th>
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
                <a href="{{ route('secretaria.alumnos.edit', $alumno->id) }}">Editar</a>

                <form action="{{ route('secretaria.alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Eliminar alumno?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
<p style="text-align:center;">No hay alumnos registrados</p>
@endif

</div>

<div class="regresar">
    <a href="{{ route('secretaria.dashboard') }}">Regresar al menú</a>
</div>

<script>
// 🔎 BUSCADOR
document.getElementById("buscar").addEventListener("keyup", function() {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tabla tbody tr");

    filas.forEach(fila => {
        let texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(filtro) ? "" : "none";
    });
});
</script>

</body>
</html>