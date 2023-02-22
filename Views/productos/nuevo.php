<?php

use Repositories\CategoriaRepository;

$categorias = CategoriaRepository::listar_inicio();

?>


<h2>Añadir Producto</h2>

<form action="productos_guardar" method="POST" enctype="multipart/form-data">
    <label for="nombre">Nombre: </label><br>
    <input required type="text" name="data[nombre]"?><br><br>
    <label for="Categoria">Categoria:</label><br>
    <select name="data[categoria]">
        <?php

            foreach ($categorias as $categoria){
                echo '<option>'.$categoria->getNombre().'</option>';
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
    

    <input type="submit" value="Crear">

    <p>*Aviso* Debes de tener en cuenta al guardar la imagen, que el nombre sea en minuscula y sin espacios.</p>
    <p>Ejemplo: Air Force Negras Retro -->  airforcenegrasretro</p>
    <p>La imagen debera de estar ubicada en el siguiente directorio: ../scr/zapatillas/foto.png</p>
</form>