<main class="contenedor">
    <h1>Reserva de servicio</h1>
    <form>
        <div class="campo">
            <label for="nombre">Nombres:</label>
            <input type="text" name="nombre" id="nombre" 
                placeholder="Nombre del cliente" required autocomplete="off">
        </div>

        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" 
                placeholder="Email del cliente" required autocomplete="off">
        </div>

        <div class="campo">
            <label for="fecha">Fecha de cita:</label>
            <input type="date" name="fecha" id="fecha">
        </div>

        <div class="from-control">
            <label for="hora">Hora de cita</label>
            <input type="time" name="hora" id="hora">
        </div>

        <div class="campo">
            <label for="servicio">Servicio</label>
            <select name="servicio" id="servicio">
                <option value="" disabled selected>--SELECCIONE--</option>
                <?php foreach($servicios as $servicio): ?>
                    <option value="<?php echo $servicio->id; ?>"><?php echo $servicio->nombre ?> </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-button">
            <input type="submit"
                id="btnRegistrarReserva"
                value="Registrar reserva" 
                class="boton boton-primario">
        </div>

    </form>
</main>


<?php $script = '<script src="/assets/js/reserva.js"></script>'; ?>