<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Secretaria</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background: #f4f6f9;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header {
    background: #1A3E5C;
    color: #fff;
    padding: 15px 35px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo-container img {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
    border: 1px solid #fff;
}

.slogan {
    font-family: 'Roboto Slab', serif;
    font-size: 1.2em;
    font-weight: 600;
}

header a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    margin-left: 18px;
    padding: 6px 12px;
    border-radius: 4px;
}

header a:hover {
    background-color: rgba(255, 255, 255, 0.15);
}

/* 🔥 ESTILO DEL BOTÓN CERRAR SESIÓN */
header form button {
    background: #ffffff;
    color: #1A3E5C;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    margin-left: 10px;
}

header form button:hover {
    background: #e6e6e6;
}

main {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 60px 20px;
}

.welcome-message h1 {
    font-family: 'Roboto Slab', serif;
    font-size: 2.2em;
    color: #1A3E5C;
}

.welcome-message h2 {
    font-size: 1.1em;
    color: #444;
    margin-bottom: 40px;
}

.buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    width: 100%;
    max-width: 600px;
    justify-items: center;
}

.buttons a {
    width: 250px;
    height: 55px;
    background: #fff;
    border: 1.8px solid #1A3E5C;
    border-radius: 6px;
    font-family: 'Roboto Slab', serif;
    font-size: 15px;
    font-weight: 600;
    color: #1A3E5C;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.buttons a:hover {
    background: #1A3E5C;
    color: #fff;
}

footer {
    background: #1A3E5C;
    color: #fff;
    padding: 15px 35px;
    display: flex;
    justify-content: flex-end;
}
</style>
</head>

<body>

<header>
    <div class="logo-container">
        <img src="{{ asset('imagenes/inca_logo.jpeg') }}" alt="Logo">
        <div class="slogan">El poder de enseñar</div>
    </div>

    <div style="display:flex; align-items:center; gap:10px;">

        <a href="https://mievaprepaabierta.sep.gob.mx/" target="_blank">Prepa Abierta SEP</a>
        <a href="https://www.inca.edu.mx/Tol" target="_blank">INCA TOLUCA</a>

        <!-- 🔥 BOTÓN CERRAR SESIÓN -->
        <form method="POST" action="{{ route('secretaria.logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>

    </div>
</header>

<main>
    <div class="welcome-message">
        <h1>Bienvenida, Secretaria</h1>
        <h2>Has iniciado sesión correctamente</h2>
    </div>

    <div class="buttons">
        <a href="{{ route('secretaria.alumnos.index') }}">Ver Lista de Alumnos</a>

        <a href="{{ route('secretaria.calificaciones') }}">Subir Calificaciones</a>
    </div>
</main>

<footer>
    <span>WhatsApp: 7222148525</span>
</footer>

</body>
</html>