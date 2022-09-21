<h1 class="nombre-pagina">Panel de administracion</h1>

<?php
include_once __DIR__ . '/../templates/barra.php';
?>

<h3>Buscar Citas</h3>
<div class="busqueda">
    <form class="formulario" action="">
        <div class="campo">
            <label for="fecha">Fecha</label>
                 <input type="date"
                        id="fecha"
                        name="fecha"
            />
        </div>
    </form>
</div>

<div id="citas-admin"> </div>