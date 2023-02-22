<?php

use Repositories\ProductosRepository;

$productos = ProductosRepository::inicio();

?>




<h2>Actualizar Producto</h2>

<form action="producto_delete" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre: </label><br>
    <select name="data[id]">
        <?php

        foreach ($productos as $producto) {
            echo '<option value="'. $producto->getId().'">' . $producto->getNombre() . '</option>';
        }
        ?>
    </select>
    <br>
    <input type="submit" value="Eliminar">

</form>