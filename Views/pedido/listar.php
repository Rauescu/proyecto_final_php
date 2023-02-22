<?php

use Repositories\PedidoRepository;

$pedidos = PedidoRepository::getAll();

?>



<h2>PEDIDOS</h2>

<div class="productos">
    <table class="gestion_productos">
        <tr> 
            <th>ID</th>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>Direccion</th>
            <th>Coste</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($pedidos as $p):?>
            <?php if($p->getUsuario_id() == $_SESSION['usuarioa'][0]) : ?>
                <tr>
                <td><?=$p->getId()?></td>
                &nbsp;
                <td><?=$p->getProvincia()?></td>
                &nbsp;
                <td> <?=$p->getLocalidad()?></td>
                &nbsp;
                <td> <?=$p->getDireccion()?></td>
                &nbsp;
                <td> <?=$p->getCoste()?>€</td>
                &nbsp;
                <td> <?=$p->getFecha()?></td>
                &nbsp;
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>