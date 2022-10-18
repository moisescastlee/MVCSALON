<div class="campo">
    <label for="nombre">Nombre</label>
    <input 
    type="text"
    id="nombre"
    placeholder="Nombre Servicio"
    name="nombre"
    value="<?php echo $apiservicio->nombre; ?>"
    />
</div>

<div class="campo">
    <label for="precio">Precio</label>
    <input 
    type="number"
    id="precio"
    placeholder="Precio"
    name="precio"
    value="<?php echo $apiservicio->precio; ?>"
    />
</div>