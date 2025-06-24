<main class="contenedor">
    <div class="productos">
        <h1>Productos</h1>
        <div class="productos__contenedor">
            <div class="productos_filtros">
                <form>
                    <div class="campo">
                        <label for="categoria">Categoria</label>
                        <select name="cat" id="servicio">
                            <option value="0" selected>--TODOS--</option>
                            <?php foreach($categorias as $categoria): ?>
                                <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row campo">
                        <div class="col">
                            <label for="min">Precio min.</label>
                            <input type="number" name="min"/>
                        </div>
                        <div class="col">
                            <label for="max">Precio max.</label>
                            <input type="number" name="max"/>
                        </div>
                    </div>
                    <div class="form-button">
                        <input type="submit"
                            value="Consultar" 
                            class="boton boton-primario">
                    </div>
                </form>
            </div>
            <div class="productos__contenido">
                <?php foreach($productos as $producto): ?>
                    <div class="producto card">
                        <img class="producto__imagen" src="<?php echo $producto->imagen ?>" alt="<?php echo $producto->nombre ?>">
                        <h3 class="producto__titulo"><?php echo $producto->nombre; ?></h3>
                        <p><?php echo $producto->descripcion; ?></p>
                        <div class="producto__info">
                            <p class="producto__precio"><?php  echo $producto->precio; ?></p>
                            <button class="boton boton-sm boton-secundario">
                                Agregar
                            </button>
                        </div>    
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>