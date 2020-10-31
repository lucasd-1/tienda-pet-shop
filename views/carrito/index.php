<h1 id="carrito-title">Carrito de la compra</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
    <table class="table table-striped w-auto">
        <thead>
        <tr>
            <th class="th-lg text-center">Producto</th>
            <th class="th-lg text-center">Cantidad</th>
            <th class="th-lg text-center">Precio</th>
            <th class="th-lg"> </th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($carrito as $indice => $elemento):
            $producto = $elemento['producto'];
            ?>
            <tr>
                <td>
                    <div class="thumbnail">
                        <?php if ($producto->imagen != null): ?>
                            <img class="thumbnail pull-left" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" />
                        <?php else: ?>
                            <img class="thumbnail pull-left" src="<?= base_url ?>assets/img/logopet.png" />
                        <?php endif; ?>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="<?= base_url ?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
                            </h4>
                        </div>
                    </div>
                </td>
                <td style="text-align: center">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <?php if ($elemento['unidades'] === 1) : ?>
                                <a style="pointer-events: none; cursor: default;" href="/#" class="btn btn-default btn-number"
                                data-type="minus" data-field="quant[1]" disabled="disabled">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </a>
                            <?php else :?>
                            <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="btn btn-default btn-number"
                               data-type="minus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-minus"></span>
                            </a>
                            <?php endif ?>
                        </span>
                        <input type="text" name="quant[1]" class="form-control input-number text-center" value="<?=$elemento['unidades']?>" min="1" max="100">
                        <span class="input-group-btn">
                            <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </span>
                    </div>
                </td>
                <td class="text-center"><strong>$<?=$producto->precio?></strong></td>
                <td class="">
                    <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove"></span> Quitar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php $stats = Utils::statsCarrito(); ?>
        <tr>
            <td>   </td>
            <td>   </td>
            <td><h3>Total</h3></td>
            <td class="text-right"><h3><strong>$<?=$stats['total']?></strong></h3></td>
        </tr>
        <tr>
            <td>
                <a href="<?=base_url?>" class="btn btn-default">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Continuar comprando
                </a>
            </td>
            <td>
                <a href="<?=base_url?>carrito/delete_all" class="btn btn-danger">
                    <span class="glyphicon glyphicon-remove"></span> Vaciar Carrito
                </a>
            </td>
            <td>   </td>
            <td>
                <a href="<?=base_url?>pedido/envio" class="btn btn-success">
                    Continuar <span class="glyphicon glyphicon-envelope"></span>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
<?php else: ?>
	<p>El carrito está vacio, añade algun producto</p>
<?php endif; ?>

