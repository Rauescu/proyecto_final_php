<?php

use Repositories\ProductosRepository;
use Repositories\CategoriaRepository;

$productos = ProductosRepository::inicio();
$categorias = CategoriaRepository::listar_inicio();

?>




<h2>Actualizar Producto</h2>

<form action="producto_update" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre: </label><br>
    <select name="data[id]">
        <?php

        foreach ($productos as $producto) {
            echo '<option value="'. $producto->getId().'">' . $producto->getNombre() . '</option>';
        }
        ?>
    </select>
    <br>

    <label for="Categoria">Categoria:</label><br>
    <select name="data[categoria]">
        <?php

        foreach ($categorias as $categoria) {
            echo '<option value="'. $categoria->getId().'">' . $categoria->getNombre() . '</option>';
        }
        ?>
    </select>
    <br><br>
    <label for="Descripcion">Descripcion: </label><br>
    <textarea name="data[descripcion]" cols="30" rows="10" required></textarea><br><br>

    <label for="precio">Precio: </label><br>
    <input required type="number" name="data[precio]" step="any" min="0"><br><br>

    <label for="stock">Stock: </label><br>
    <input required type="number" name="data[stock]" min="0"><br><br>

    <label for="oferta"> Oferta: </label><br>
    <input required type="number" name="data[oferta]" value=0 min="0" step="any"><br><br>


    <input type="submit" value="Actualiar">

</form>