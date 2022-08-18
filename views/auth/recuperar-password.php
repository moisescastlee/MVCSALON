
<h1 class="nombre-pagina">Recupera tu cuenta</h1>
<p class="descripcion-pagina">Coloca tu nuevo password</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    
    <div class="campo">
        <label for="password">Password</label>
        
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu Nuevo Password"
        />

        
    </div>

        <input
        type="submit"
        class="boton"
        value="Guardar Nuevo Password">
</form>

<div class="acciones">
    <a href="/public/">Iniciar seccion</a>
    <a href="/public/crear-cuenta">Quieres crear una nueva?</a>
</div>

