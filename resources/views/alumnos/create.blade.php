<!DOCTYPE html>
<html>
<head>
    <title>Registrar Alumno</title>
</head>
<body>
    <h1>Registrar Alumno</h1>

    @if ($errors->any())
        <div style="color:rgb(255, 0, 0);">
            
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumnos.store') }}" method="POST">
        @csrf
        <label>Nombre completo:</label><br>
        <input type="text" name="nombre_completo" value="{{ old('nombre_completo') }}"><br><br>

        <label>Matrícula INCA:</label><br>
        <input type="text" name="matricula_inca" value="{{ old('matricula_inca') }}"><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" value="{{ old('correo') }}"><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" value="{{ old('telefono') }}"><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="{{ route('alumnos.index') }}">Ver lista de alumnos</a>
</body>
</html>
