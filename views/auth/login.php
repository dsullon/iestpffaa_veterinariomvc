<main class="contenedor">
    <div class="login">
        <h1 class="login__titulo">Inicio de sesión</h1>
        <form action="">
            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario">
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input type="password" id="password">
            </div>
            <div class="form-button">
                <input type="submit"
                    id="btnRegistrarReserva"
                    value="Iniciar sesión" 
                    class="boton boton-secundario">
            </div>
            <div class="login__acciones">
                <a class="login__enlace" href="/auth/olvide">Olvidé mi contraseña</a>
                <a class="login__enlace" href="/auth/registro">¿No eres usuario? Regístrate</a>
            </div>
        </form>
    </div>
</main>