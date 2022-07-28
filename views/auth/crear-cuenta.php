<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
             type="text"
             id="nombre"
             placeholder="Su nombre"
             name="nombre"
             value="<?php echo s($usuario->nombre); ?>"
        />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
             type="text"
             id="apellido"
             placeholder="Su apellido"
             name="apellido"
             value="<?php echo s($usuario->apellido); ?>"
        />
    </div>

    <div class="campo">
        <label for="numero">Su numero</label>
        <input 
             type="tel"
             id="telefono"
             placeholder="Su telefono"
             name="telefono"
             value="<?php echo s($usuario->telefono); ?>"
        />
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input 
             type="email"
             id="email"
             placeholder="Su email"
             name="email"
             value="<?php echo s($usuario->email); ?>"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
             type="password"
             id="password"
             placeholder="Tu password"
             name="password"
             
        />
    </div>

    <input type="submit" class="boton" name="" id="" value="crear cuenta">
</form>

<div class="acciones">

<a href="login">Ya tienes una cuenta?</a>
<a href="/public/olvide">Olvide mi password!</a>
</div>
