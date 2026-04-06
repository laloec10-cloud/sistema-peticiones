<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Alumno</title>

<style>

body{
font-family: Arial, Helvetica, sans-serif;
background:#f4f6f9;
margin:0;
padding:0;
}

.container{
width:500px;
margin:50px auto;
background:white;
padding:30px;
border-radius:8px;
box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

h2{
text-align:center;
margin-bottom:20px;
}

label{
font-weight:bold;
}

input{
width:100%;
padding:8px;
margin-top:5px;
border:1px solid #ccc;
border-radius:5px;
}

button{
background:#3490dc;
color:white;
border:none;
padding:10px 15px;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2779bd;
}

a{
margin-left:10px;
text-decoration:none;
color:#555;
}

</style>

</head>

<body>

<div class="container">

<h2>Editar Alumno</h2>

<form action="{{ route('secretaria.alumnos.update', $alumno->id) }}" method="POST">

@csrf
@method('PUT')

<div>
<label>Nombre Completo</label>
<input type="text" name="nombre_completo" value="{{ $alumno->nombre_completo }}" required>
</div>

<br>

<div>
<label>Matrícula</label>
<input type="text" name="matricula_inca" value="{{ $alumno->matricula_inca }}" required>
</div>

<br>

<div>
<label>CURP</label>
<input type="text" name="curp" value="{{ $alumno->curp }}" required>
</div>

<br>

<div>
<label>Correo</label>
<input type="email" name="correo" value="{{ $alumno->correo }}" required>
</div>

<br>

<div>
<label>Teléfono</label>
<input type="text" name="telefono" value="{{ $alumno->telefono }}">
</div>

<br><br>

<button type="submit">Actualizar Alumno</button>

<a href="{{ route('secretaria.alumnos.index') }}">Cancelar</a>

</form>

</div>

</body>
</html>