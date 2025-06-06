<main class="contenedor">
    <div class="productos">
        <h1>Productos</h1>
        <div class="productos__contenido">
            <?php foreach($productos as $producto): ?>
                <div class="producto">
                    <div class="producto__imagen">
                        <img src="<?php echo $producto->imagen ?>" alt="<?php echo $producto->nombre ?>">
                    </div>
                    <p><?php echo $producto->nombre; ?></p>
                    <p><?php echo $producto->descripcion; ?></p>
                    <p><?php  echo $producto->precio; ?></p>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>