<h1>Servicios</h1>
<hr>
<a href="/servicios/crear">Nuevo Servicio</a>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descipción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($servicios as $servicio): ?>
            <tr>
                <td><?php echo $servicio->nombre; ?></td>
                <td><?php echo $servicio->descripcion; ?></td>
                <td><?php echo $servicio->precio; ?></td>
                <td><?php echo $servicio->imagen; ?></td>
                <td>
                    <a href="/servicios/editar?id=<?php echo $servicio->id; ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>