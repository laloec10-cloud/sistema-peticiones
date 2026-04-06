<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Alumno</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #e9edf2, #cfd8e4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.15);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        h1 {
            font-family: 'Roboto Slab', serif;
            color: #1A3E5C;
            font-size: 26px;
            margin-bottom: 25px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #1A3E5C;
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #1A3E5C;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        button:hover {
            background-color: #16314a;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.12);
        }

        .login-link {
            margin-top: 20px;
            font-size: 14px;
            color: #555555;
        }

        .login-link a {
            color: #1A3E5C;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #16314a;
            text-decoration: underline;
        }

        .error-list {
            color: #c53030;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
        }

        .success {
            color: #2F855A;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Alumno</h1>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de registro -->
        <form action="{{ route('alumno.register.post') }}" method="POST">
            @csrf
            <input type="text" name="nombre_completo" placeholder="Nombre completo" value="{{ old('nombre_completo') }}" required>
            <input type="text" name="matricula_inca" placeholder="Matrícula INCA" value="{{ old('matricula_inca') }}" required>
            <input type="text" name="curp" placeholder="CURP" value="{{ old('curp') }}" maxlength="18" style="text-transform:uppercase;" required>
            <input type="email" name="correo" placeholder="Correo" value="{{ old('correo') }}" required>
            <input type="text" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}">
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Registrar</button>
        </form>

        <div class="login-link">
            <p>¿Ya tienes cuenta? <a href="{{ route('alumno.login') }}">Iniciar sesión</a></p>
        </div>
    </div>
</body>
</html>