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
        </li>

    <?php } ?>
</ul>