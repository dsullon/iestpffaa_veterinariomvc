<h1>Editar Servicio</h1>
<p><strong><?php echo $mensaje; ?></strong></p>
<?php foreach ($errores as $error):?>
    <p><?php echo $error;?></p>
<?php endforeach; ?>
<form method="post">
    <?php include_once __DIR__ . '/_formulario.php'; ?>    
    <input type="submit" value="Actualizar">
</form>