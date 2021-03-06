<h1>Detalle del pedido</h1>

<?php if (isset($pedido)): ?>
    <?php if (isset($_SESSION['admin'])): ?>
        <h3>Cambiar estado del pedido</h3>
        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" value="<?= $pedido->id ?>" name="pedido_id"/>
            <select name="estado">
                <?php while($est = $estados->fetch_object()): ?>
                    <option value=<?=$est->id?> <?= $pedido->id_estado_pedido == $est->id ? 'selected' : ''; ?>><?=$est->descripcion?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Cambiar estado" />
        </form>
        <br/>
    <?php endif; ?>

    <h3>Dirección de envio</h3>
    Provincia: <?= $pedido->provincia ?>   <br/>
    Cuidad: <?= $pedido->localidad ?> <br/>
    Direccion: <?= $pedido->direccion ?>   <br/><br/>

    <h3>Datos del pedido:</h3>
    Estado: <?= utils::showStatus($pedido->id_estado_pedido)?> <br/>
    Número de pedido: <?= $pedido->id ?>   <br/>
    Total a pagar: <?= $pedido->coste ?> $ <br/>
    Productos:

    <table>
        <tr>
            <th style="text-align: center">Imagen</th>
            <th style="text-align: center">Nombre</th>
            <th style="text-align: center">Precio</th>
            <th style="text-align: center">Unidades</th>
        </tr>
        <?php while ($producto = $productos->fetch_object()): ?>
            <tr>
                <td>
                    <?php if ($producto->imagen != null): ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
                    <?php else: ?>
                        <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" />
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                </td>
                <td>
                   $ <?= $producto->precio ?>
                </td>
                <td>
                    <?= $producto->unidades ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php endif; ?>