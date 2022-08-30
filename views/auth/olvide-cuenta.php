<h1 class="nombre-pagina">Olvidaste tu cuenta</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuacion</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/public/olvide">
<div class="campo">
        <label for="email">Email</label>
        <input 
             type="email"
             id="email"
             placeholder="Su email"
             name="email"
        />
    </div>

    <input type="submit" class="boton" name="" id="" value="Enviar verificacion">
</form>

<div class="acciones">

<a href="crear-cuenta">Ya tienes una cuenta?</a>
<a href="/">Iniciar seccion</a>
</div>