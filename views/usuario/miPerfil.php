<h1>Mi perfil</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete') :?>
    <?php if($_SESSION['register'] === 'complete') :?>
        <p>
            <strong class="alert_green">Datos actualizados correctamente</strong>
        </p>
    <?php elseif($_SESSION['register'] === 'failed') :?>
        <p>
            <strong class="alert_red">Hubo un problema al guardar los datos</strong>
        </p>
    <?php endif ?>
<?php endif; ?>
<?php unset($_SESSION['register']) ?>
<?php if(isset($_SESSION['identity'])) :?>
<ul>
    <li>Nombre: <?=$usuario->nombre?> <?=$usuario->apellido?></li>
    <li>Email: <?=$usuario->email?></li>
    <li>Username: <?=$usuario->username?></li>
    <li>DNI: <?=$usuario->dni?></li>
    <li>Teléfono: <?=$usuario->telefono?></li>
    <li>Dirección: <?=$usuario->direccion?></li>
    <li>Localidad: <?=$localidad->getLocalidad()?></li>
    <li>Provincia: <?=$provincia->getProvincia()?></li>
</ul>

<a href="<?=base_url?>usuario/editar" class="btn btn-primary">Editar</a>

<?php else :?>
<h1>Necesitas estar identificado</h1>
<p>Para poder ver tus datos necesitas estar logueado</p>
<?php endif; ?>