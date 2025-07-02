<main class="contenedor">
    <div class="confirmar mt-2">
        <h1>Confirmación de cuenta</h1>
        <div class="confirmar__contenido">
            <p class="<?php echo $estado ? 'text-success' : 'text-error' ?>"><?php echo $mensaje ?></p>
            <p>
                <a href="/login">Iniciar sesión</a> | 
                <a href="/">Regresar</a>
            </p>
        </div>
    </div>
</main>