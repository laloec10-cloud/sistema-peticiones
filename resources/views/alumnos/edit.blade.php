<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Alumno</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e9edf2, #cfd8e4);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    width: 400px;
}

h1 {
    color: #1A3E5C;
    margin-bottom: 20px;
    text-align: center;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

input:focus {
    border-color: #1A3E5C;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #1A3E5C;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
}

button:hover {
    background-color: #16314a;
}

.back-link {
    text-align: center;
    margin-top: 15px;
}

.back-link a {
    text-decoration: none;
    color: #1A3E5C;
    font-weight: 600;
}
</style>
</head>
<body>

<div class="container">
    <h1>Editar Alumno</h1>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nombre_completo" 
            value="{{ old('nombre_completo', $alumno->nombre_completo) }}" 
            required>

        <input type="text" name="matricula_inca" 
            value="{{ old('matricula_inca', $alumno->matricula_inca) }}" 
            required>

        <input type="text" name="curp" 
            value="{{ old('curp', $alumno->curp) }}" 
            maxlength="18"
            style="text-transform: uppercase;"
            required>

        <input type="email" name="correo" 
            value="{{ old('correo', $alumno->correo) }}" 
            required>

        <input type="text" name="telefono" 
            value="{{ old('telefono', $alumno->telefono) }}">

        <button type="submit">Actualizar Alumno</button>
    </form>

    <div class="back-link">
        <a href="{{ route('alumnos.index') }}">← Volver a la lista</a>
    </div>
</div>

</body>
</html>