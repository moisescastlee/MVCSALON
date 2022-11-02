<h1 class="nombre-pagina">Servicios</h1>

<p class="descripcion-pagina"> Administracion de Servicios</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<ul     class="servicios">
    <?php foreach($apiservicio as $apiservicios) { ?>
        <li>
            <p>Nombre: <span> <?php echo $apiservicios->nombre; ?></span> </p>
            <p>Precio: <span> <?php echo $apiservicios->precio; ?></span> </p>

        <div class="acciones">
        <a class="boton" href="/servicios/actualizar">Actualizar</a>

        <form action="/servicios/eliminar" method="POST">
        <input type="hidden" name="id" value="<?php echo $apiservicios->id; ?>">
        <input type="submit" value="Borrar" class="boton-eliminar">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>