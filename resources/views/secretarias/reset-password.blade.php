<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reset de contraseñas</title>

<style>
body{
    font-family: Arial;
    background:#eef2f7;
    display:flex;
    justify-content:center;
    padding:30px;
}

.box{
    background:white;
    padding:20px;
    border-radius:12px;
    width:500px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.alumno{
    border:1px solid #ddd;
    padding:10px;
    margin-bottom:10px;
    border-radius:8px;
}

input, button{
    width:100%;
    padding:8px;
    margin-top:5px;
}

button{
    background:#1A3E5C;
    color:white;
    border:none;
}
</style>
</head>
<body>

<div class="box">

<h2>Lista de alumnos</h2>

@foreach($alumnos as $alumno)

<div class="alumno">

    <strong>{{ $alumno->nombre_completo }}</strong><br>
    Matrícula: {{ $alumno->matricula_inca }}

    <form method="POST" action="{{ route('secretaria.reset.password.post') }}">
        @csrf

        <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">

        <input type="password" name="password" placeholder="Nueva contraseña" required>

        <button type="submit">Cambiar contraseña</button>
    </form>

</div>

@endforeach

</div>

</body>
</html>