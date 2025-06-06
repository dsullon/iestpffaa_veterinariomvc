<main class="contenedor">
    <section class="servicios">
        <h1>Servicios</h1>
        <div class="servicios__contenido">
            <?php foreach ($servicios as $servicio): ?>
            <div class="servicio">
                <div class="servicio__imagen">
                    <img src="<?php echo $servicio->imagen; ?>" alt="">
                </div>
                <p class="servicio__titulo"><?php echo $servicio->nombre; ?></p>
                <p class="servicio__descripcion"><?php echo $servicio->descripcion; ?></p>
                <p class="servicio__precio"><?php echo $servicio->precio; ?></p>
            </div>
            <?php endforeach;?>
        </div>
    </section>
</main>

