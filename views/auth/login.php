<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia session con tus datos</p>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input 
             type="email"
             id="email"
             placeholder="Tu email"
             name="email"
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input
             type="password"
             id="password"
             placeholder="Tu Password"
             name="password"
        />
    </div>

    <input type="submit" class="boton" name="" id="" value="Iniciar Sesion">
</form>

<div class="acciones">

    <a href="crear-cuenta">Todavia no tienes una cuenta?</a>
    <a href="olvide">Olvide mi password!</a>
</div>