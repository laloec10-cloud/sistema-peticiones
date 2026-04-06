<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Subir / Editar Calificaciones</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/*  BUSCADOR */
.buscador {
    width: 90%;
    margin: 20px auto;
    text-align: right;
}

.buscador input {
    padding: 8px;
    width: 250px;
    border: 1px solid #ccc;
}

/* TABLA */
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
}

td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

input {
    width: 70px;
    text-align: center;
    background: #e9ecef;
    border: 1px solid #ccc;
}

input.editable {
    background: #fff;
    border: 2px solid #1A3E5C;
}

button {
    padding: 5px 10px;
    background: #1A3E5C;
    color: white;
    border: none;
    cursor: pointer;
    font-size: 14px;
}

button:hover {
    background: #16304a;
}

.success {
    text-align: center;
    color: green;
    margin-top: 20px;
    font-weight: bold;
}

/*  BOTÓN ABAJO DERECHA */
.regresar-bottom {
    width: 90%;
    margin: 10px auto 30px;
    display: flex;
    justify-content: flex-end;
}

.regresar-bottom a {
    padding: 8px 15px;
    background: #1A3E5C;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.regresar-bottom a:hover {
    background: #16304a;
}
</style>
</head>

<body>

<h2 style="text-align:center">Subir / Editar Calificaciones</h2>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<!--🔍 BUSCADOR -->
<div class="buscador">
    <input type="text" id="buscar" placeholder="Buscar por nombre, módulo, fecha...">
</div>

<table id="tabla">
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Módulo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Calificación</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        @forelse($examenes as $e)
        <tr>
            <td>{{ $e->alumno }}</td>
            <td>{{ $e->modulo }}</td>
            <td>{{ $e->fecha }}</td>
            <td>{{ $e->hora }}</td>

            <td>
                <form method="POST" action="{{ route('secretaria.calificacion.editar', $e->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="number" name="calificacion" min="0" max="10"
                        value="{{ $e->calificacion ?? '' }}" readonly>
            </td>

            <td>
                    <button type="button" onclick="activarEdicion(this)">Editar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No hay exámenes solicitados</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!--  BOTÓN ABAJO DERECHA -->
<div class="regresar-bottom">
    <a href="{{ route('secretaria.dashboard') }}"> Regresar al menú</a>
</div>

<script>
//  EDITAR / GUARDAR
function activarEdicion(boton) {
    const fila = boton.closest('tr');
    const input = fila.querySelector('input[name="calificacion"]');
    const form = fila.querySelector('form');

    if (boton.dataset.editando === "true") {
        if (input.value === "") {
            alert("Ingrese una calificación antes de guardar.");
            input.focus();
            return;
        }
        form.submit();
        return;
    }

    input.removeAttribute('readonly');
    input.classList.add('editable');
    input.focus();

    boton.textContent = "Guardar";
    boton.dataset.editando = "true";
}

//   BUSCADOR
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