<main class="contenedor">
    <div class="compra mt-2">
        <h1>Pago</h1>
        <div class="compra__contenedor">
            <section class="compra__cliente">
                <h2>Datos del Cliente</h2>
                <dl>
                    <dt>Nombre:</dt>
                    <dd><?php echo $usuario->nombres; ?></dd>

                    <dt>Dirección:</dt>
                    <dd><?php echo $usuario->direccion; ?></dd>

                    <dt>Email:</dt>
                    <dd><?php echo $usuario->email; ?></dd>

                    <dt>Teléfono:</dt>
                    <dd><?php echo $usuario->telefono; ?></dd>
                </dl>
            </section>
            <section class="compra__pedido">
                <h2>Resumen del Pedido</h2>
                <details>
                    <summary>Ver productos del pedido</summary>
                    <dl>
                        <?php foreach ($items as $item): ?>
                            <dt><?php echo $item['nombre']?></dt>
                            <dd>S/ <?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </details>
                <p class="total">Total a pagar: S/ <?php echo number_format($total, 2); ?></p>
                <form>
                    <input hidden value="<?php echo $usuario->email; ?>" id="email">
                    <input hidden value="<?php echo $total; ?>" id="total">
                </form>
                <input type="submit"
                        id="btnPagarPedido"
                        value="Pagar" 
                        class="boton boton-primario">
            </section>

        </div>
        <div class="compra__detalle">

        </div>
    </div>
</main>

<?php $script = '
    <script src="https://checkout.culqi.com/js/v4"></script>
    <script src="/assets/js/pago.js"></script>
'; ?>

