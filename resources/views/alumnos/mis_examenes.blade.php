<!DOCTYPE html> 
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Exámenes</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Roboto+Slab:wght@600;700&display=swap');

body{
    margin:0;
    font-family:'Roboto', sans-serif;
    background:#f4f6f9;
    min-height:100vh;
    display:flex;
    flex-direction:column;
    align-items:center;
    padding:60px 20px;
}

/* CONTENEDOR */
.container{
    width:100%;
    max-width:900px;
}

/* TÍTULO */
h2{
    font-family:'Roboto Slab', serif;
    color:#1A3E5C;
    margin-bottom:25px;
    font-size:1.9em;
    text-align:center;
}

/* TABLA */
table{
    width:100%;
    border-collapse:collapse;
    background:#ffffff;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

/* ENCABEZADO */
thead{
    background:#1A3E5C;
    color:#ffffff;
}

th{
    padding:14px;
    font-weight:600;
    font-size:14px;
    text-align:center;
}

/* CUERPO */
td{
    padding:12px;
    border-top:1px solid #e2e6ea;
    text-align:center;
    font-size:14px;
    color:#333;
}

/* FILAS */
tbody tr:nth-child(even){
    background:#f8fafc;
}

tbody tr:hover{
    background:#eef3f7;
}

/* MENSAJE VACÍO */
.vacio{
    padding:20px;
    font-style:italic;
    color:#555;
}

/* BOTÓN */
.regresar{
    margin-top:20px;
    display:flex;
    justify-content:flex-end;
}

.regresar a{
    padding:8px 16px;
    background:#1A3E5C;
    color:white;
    text-decoration:none;
    border-radius:6px;
    font-size:13px;
    font-weight:600;
    transition:0.3s;
}

.regresar a:hover{
    background:#16304a;
}
</style>
</head>

<body>

<div class="container">

    <h2>Mis Exámenes Solicitados</h2>

    <table>
        <thead>
            <tr>
                <th>Módulo</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>

        <tbody>
            @forelse($examenes as $e)
            <tr>
                <td>{{ $e->calendario->modulo }}</td>
                <td>{{ $e->fecha }}</td>
                <td>{{ $e->hora }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="vacio">No tienes exámenes solicitados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!--  BOTÓN -->
    <div class="regresar">
        <a href="{{ route('alumno.dashboard') }}"> Regresar al menú</a>
    </div>

</div>

</body>
</html>