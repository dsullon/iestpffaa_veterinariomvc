<main class="contenedor">
    <div class="carrito">
        <h1>Mi pedido</h1>
        <div class="carrito__contenedor">
            <div class="carrito__contenido">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Producto</th>
                            <th class="text-right">Precio</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-right">Importe</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <?php 
                            $total = 0;
                            foreach($carrito as $producto):
                                $importe = $producto['cantidad'] * $producto['precio'];
                                $total += $importe;

                        ?>
                            <tr>
                                <td>
                                    <img class="carrito__imagen" src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                                </td>
                                <td><?php echo $producto['nombre']; ?></td>
                                <td class="text-right"><?php echo $producto['precio']; ?></td>
                                <td class="text-center"><?php echo $producto['cantidad']; ?></td>
                                <td class="text-right"><?php echo number_format($importe, 2); ?></td>
                                <td>
                                    <button class="boton boton-sm btnQuitarCarrito"
                                        data-producto="<?php echo $producto['id']; ?>">
                                        <img src="assets/img/trash.svg" alt="Eliminar articulo">
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total</th>
                            <th class="text-right"><?php echo number_format($total, 2); ?></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="carrito__acciones">
                    <a href="/compra" class="boton boton-secundario">Comprar</a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $script = '<script src="/assets/js/carrito.js"></script>'; ?>