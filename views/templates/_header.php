<?php
use Classes\SessionHelper;
$usuario = SessionHelper::get('usuario');
?>
<header class="header">
    <div class="header__top">
        <div class="header__top__contenido contenedor">
            <img class="header__logo" src="/assets/img/logo.svg" alt="Logo" />
            <div class="header__acciones">
                <?php if(isset($usuario)): ?>
                    <a href="/clientes" class="header__link">
                        <img src="/assets/img/user.svg" alt="Iniciar sesión">
                        <span><?php echo $usuario['nombre']; ?></span>
                    </a>
                <?php else: ?>
                    <a href="/login" class="header__link">
                        <img src="/assets/img/user.svg" alt="Iniciar sesión">
                        <span>Iniciar sesión</span>
                    </a>
                <?php endif; ?>

                <a href="/carrito" class="header__link header__carrito">
                    <img src="/assets/img/shopping-cart.svg" alt="Carrito">
                    <span>Carrito</span>
                </a>
            </div>
        </div>
    </div>
    <div class="header__nav">
        <div class="header__nav__contenido contenedor">
            <a href="/">Inicio</a>
            <a href="/nosotros">Nosotros</a>
            <a href="/servicios">Servicios</a>
            <a href="/productos">Productos</a>
            <a href="/reservas/crear">Reservas</a>
            <a href="/contacto">Contacto</a>
        </div>
    </div>
</header>