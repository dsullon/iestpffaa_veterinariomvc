<main class="contenedor">
    <div class="registro mt-2">
        <h1>Registrar usuario</h1>
        <div class="registro__contenedor">
            <div class="registro__info">

            </div>
            <div class="registro__contenido">
                <form>
                    <div class="campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" placeholder="Nombre del usuario" autocomplete="off">
                    </div>
                    <div class="campo">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Email del usuario" autocomplete="off">
                    </div>
                    <div class="campo">
                        <label for="telefono">Telefono</label>
                        <input type="tel" id="telefono" placeholder="Teléfono del usuario" autocomplete="off">
                    </div>
                    <div class="campo">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" placeholder="Dirección del usuario" autocomplete="off">
                    </div>
                    <p><strong>Datos de inicio de sesión</strong></p>
                    <div class="campo">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" placeholder="*****" autocomplete="off">
                    </div>
                    <div class="campo">
                        <label for="password2">Confirmar la contraseña</label>
                        <input type="password" id="password2" placeholder="*****" autocomplete="off">
                    </div>
                    <div class="form-button">
                        <input type="submit" id="btnRegistrarUsuario" value="Registrar" class="boton boton-secundario">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $script = '<script src="/assets/js/usuario.js"></script>'; ?>