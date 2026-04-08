<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Solicitar Examen</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Roboto+Slab:wght@500;700&display=swap');
body{
    margin:0;
    font-family:'Roboto', sans-serif;
    background:#f4f6f9;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}
.container{
    background:#ffffff;
    padding:45px 50px;
    border-radius:8px;
    width:100%;
    max-width:520px;
    border:1px solid #dcdcdc;
}
h2{
    text-align:center;
    font-family:'Roboto Slab', serif;
    color:#1A3E5C;
    margin-bottom:35px;
    font-weight:700;
}
label{
    font-weight:600;
    color:#333;
    display:block;
    margin-bottom:6px;
}
select{
    width:100%;
    padding:12px;
    border-radius:5px;
    border:1px solid #bfc5cc;
    margin-bottom:25px;
    font-size:15px;
    background:#ffffff;
}
select:focus{
    outline:none;
    border-color:#1A3E5C;
}
button{
    width:100%;
    padding:13px;
    border:1px solid #1A3E5C;
    border-radius:5px;
    background:#1A3E5C;
    color:#ffffff;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
}
button:hover{
    background:#16324a;
}
.success{
    background:#1A3E5C;
    color:#ffffff;
    padding:12px;
    border-radius:5px;
    text-align:center;
    margin-bottom:20px;
    font-size:14px;
}
</style>
</head>
<body>

<div class="container">

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<h2>Solicitar Examen</h2>

<form method="POST" action="{{ route('alumno.examen.guardar') }}">
@csrf

<!-- MÓDULO -->
<label>Seleccione el módulo</label>
<select id="modulo" name="modulo" required>
    <option value="">Seleccione un módulo</option>
    @foreach($modulos as $m)
        <option value="{{ $m->clave }}">{{ $m->clave }} - {{ $m->modulo }}</option>
    @endforeach
</select>

<!-- ETAPA -->
<label>Seleccione la etapa</label>
<select id="etapa" name="etapa" required>
    <option value="">Seleccione etapa</option>
    <option value="A">A</option>
    <option value="B">B</option>
</select>

<!-- FECHA -->
<label>Seleccione la fecha disponible</label>
<select id="fecha" name="fecha_id" required>
    <option value="">Seleccione fecha</option>
</select>

<button type="submit">Agendar examen</button>
</form>

</div>

<script>
// Función para cargar fechas según módulo y etapa
function cargarFechas() {
    let modulo = document.getElementById('modulo').value;
    let etapa = document.getElementById('etapa').value;

    console.log('Módulo:', modulo, 'Etapa:', etapa);

    if(modulo && etapa){
        let url = "{{ url('alumno/fechas-filtradas') }}/" + modulo + "/" + etapa;
        fetch(url)
            .then(res => res.json())
            .then(data => {
                let select = document.getElementById('fecha');
                select.innerHTML = '<option value="">Seleccione fecha</option>';

                if(data.length > 0){
                    data.forEach(f => {
                        select.innerHTML += `<option value="${f.id}">${f.fecha_formateada} - ${f.hora}</option>`;
                    });
                } else {
                    select.innerHTML += '<option value="">No hay fechas disponibles</option>';
                }

                console.log('Fechas recibidas:', data);
            })
            .catch(err => console.error('Error al cargar fechas:', err));
    }
}

// Eventos
document.getElementById('modulo').addEventListener('change', cargarFechas);
document.getElementById('etapa').addEventListener('change', cargarFechas);
</script>

</body>
</html>