<?php if(isset($gestion)) : ?>
<h1>Gestionar pedidos</h1>
<?php else : ?>
<h1>Mis pedidos</h1>
<?php endif; ?>
<table>
    <tr>
        <th style="text-align: center">N° Pedido</th>
        <th style="text-align: center">Costo</th>
        <th style="text-align: center">Fecha</th>
        <th style="text-align: center">Estado</th>
    </tr>
  <?php 
        while($ped = $pedidos->fetch_object()) :
    ?>
    
    <tr>
        <td>
            <a href="<?=base_url?>pedido/detalle&id=<?=$ped->id?>"><?=$ped->id?></a>
    </td>
        <td>$ <?=$ped->coste?></td>
        <td><?=$ped->fecha?></td>
        <td><?= utils::showStatus($ped->id_estado_pedido)?></td>
    </tr>
    
  <?php endwhile;?>
</table>