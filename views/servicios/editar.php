<h1>Editar Servicio</h1>
<p><strong><?php echo $mensaje; ?></strong></p>
<form method="post">
    <label for="nombre">Nombre:</label>
    <input id="nombre" name="nombre" type="text" 
        autocomplete="off" value="<?php echo $servicio->nombre; ?>">

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"><?php echo $servicio->descripcion ?></textarea>

    <label for="precio">Precio:</label>
    <input type="text" id="precio" name="precio" autocomplete="off"
        value="<?php echo $servicio->precio; ?>">
    
    <input type="submit" value="Actualizar">
</form>