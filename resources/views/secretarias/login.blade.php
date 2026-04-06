<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Secretaria</title>
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
        background-color: #ffffff;
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0 16px 40px rgba(0,0,0,0.15);
        width: 100%;
        max-width: 400px;
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

    .errors {
        color: #c53030;
        margin-bottom: 15px;
        font-size: 14px;
        text-align: left;
    }

    .register-link {
        margin-top: 20px;
        font-size: 14px;
        color: #555555;
    }

    .register-link a {
        color: #1A3E5C;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .register-link a:hover {
        color: #16314a;
        text-decoration: underline;
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
    <h1>Login Secretaria</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('secretaria.login.post') }}" method="POST">
        @csrf
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <div class="register-link">
        <p>¿No tienes cuenta? 
            <a href="{{ route('secretaria.register') }}">
                Registrarse como Secretaria
            </a>
        </p>
    </div>
</div>
</body>
</html>