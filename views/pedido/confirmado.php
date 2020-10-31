<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
<h1>Tu pedido se ha confirmado</h1>
<p>
    Tu pedido ha sido guardado con éxito, una vez que realices el pago por 
    transferencia bancaria a la cuenta DDDA39751 con el costo del pedido, será procesado y enviado.
</p>
    </br>
    
    <?php if(isset($pedido)): ?>
    <h3>Datos del pedido</h3>

    Número de pedido: <?=$pedido->id?> </br>
    Total a pagar: $<?=$pedido->coste?> </br>
    <p>
        Productos:
    </p>
        <table>
        <tr>
                    <th style="text-align: center">Imagen</th>
                    <th style="text-align: center">Nombre</th>
                    <th style="text-align: center">Precio</th>
                    <th style="text-align: center">Unidades</th>
                </tr>
    <?php while($producto = $productos->fetch_object()) :?>
    <tr>
        <td>
            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen?>" class="img_carrito"/>
        </td>
        <td><a href="<?= base_url ?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a></td>
        <td> $ <?= $producto->precio ?></td>
        <td><?=$producto->unidades?></td>
            
    </tr>
    <?php endwhile ; ?>
    </table>
    <?php endif; ?>
    
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
<h1>Tu pedido NO ha podido procesarse</h1>
<p><?= $_SESSION['debug'] ?></p>
<p><?= $_SESSION['debug2'] ?></p>

<?php endif; ?>
