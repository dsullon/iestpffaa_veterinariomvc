<h1>Servicios</h1>
<hr>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descipción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($servicios as $servicio): ?>
            <tr>
                <td><?php echo $servicio->nombre; ?></td>
                <td><?php echo $servicio->descripcion; ?></td>
                <td><?php echo $servicio->precio; ?></td>
                <td>
                    <a href="/servicios/editar?id=<?php echo $servicio->id; ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>