<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Peticiones de Exámenes</title>
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
        padding: 50px 60px;
        border-radius: 15px;
        box-shadow: 0 16px 40px rgba(0,0,0,0.15);
        max-width: 500px;
        width: 90%;
        text-align: center;
    }

    .logo {
        width: 80px;
        margin-bottom: 20px;
    }

    h1 {
        font-family: 'Roboto Slab', serif;
        color: #1A3E5C;
        font-size: 28px;
        margin-bottom: 15px;
    }

    p {
        font-size: 17px;
        color: #555555;
        margin-bottom: 35px;
    }

    .cards {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .card {
        background-color: #f9f9f9;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        width: 180px;
        padding: 25px 15px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: #1A3E5C;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        border-color: #1A3E5C;
        background-color: #f0f4f8;
    }

    .card img {
        width: 50px;
        margin-bottom: 12px;
    }
</style>
</head>
<body>
<div class="container">
    <img src="/imagenes/inca_logo.jpeg" alt="Logo" class="logo">
    <h1>Bienvenido</h1>
    <p>Selecciona tu tipo de usuario para ingresar al sistema:</p>

    <div class="cards">
        <a href="{{ route('alumno.login') }}" class="card">
            <img src="/imagenes/alumno_icon.png" alt="Alumno">
            Alumno
        </a>
        <a href="{{ route('secretaria.login') }}" class="card">
            <img src="/imagenes/secretaria_icon.png" alt="Secretaria">
            Secretaria
        </a>
    </div>
</div>
</body>
</html>
