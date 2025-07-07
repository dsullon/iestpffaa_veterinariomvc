<div class="contenedor">
    <div class="cliente-wrapper mt-2">
        <div class="cliente__nav">
            <?php include_once __DIR__ . '/../templates/_sidebar_cliente.php'; ?>
        </div>
        <div class="cliente__contenido">
            <h1>Mis pedidos</h1>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido):?>
                        <tr>
                            <td><?php echo $pedido->codigo; ?></td>
                            <td><?php echo $pedido->fecha; ?></td>
                            <td class="text-right" style="width: 80px;"><?php echo number_format($pedido->total, 2); ?></td>
                            <td><?php echo $pedido->estado; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>