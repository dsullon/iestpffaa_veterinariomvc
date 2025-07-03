<main class="contenedor">
    <section class="servicios mt-2">
        <h1>Servicios</h1>
        <p class="mt-2">
            Sabemos cuánto amas a tu mascota, por eso en <strong><?php echo $_ENV['APP_NAME'] ?></strong> te ofrecemos atención con cariño y compromiso. Contamos con servicios de consulta veterinaria, vacunación, baño y peluquería, todo pensado para su salud, bienestar y alegría. Porque su felicidad también es la nuestra.
        </p>
        <div class="servicios__contenido mt-2">
            <?php foreach ($servicios as $servicio): ?>
            <div class="servicio card">
                <div class="servicio__imagen">
                    <img src="<?php echo $servicio->imagen; ?>" alt="">
                </div>
                <p class="servicio__titulo"><?php echo $servicio->nombre; ?></p>
                <p class="servicio__descripcion"><?php echo $servicio->descripcion; ?></p>
                <p class="servicio__precio"><?php echo $servicio->precio; ?></p>
                <a href="/reservas/crear" class="boton boton-secundario">🐶 ¡Haz tu cita ahora!</a>
            </div>
            <?php endforeach;?>
        </div>
    </section>
</main>

