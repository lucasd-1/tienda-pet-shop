<h1>Mi perfil</h1>

<?php if(isset($_SESSION['identity'])) :?>
<h3>Editar Datos Personales:</h3>

<form action="<?=base_url?>usuario/edit" method="POST">
	<label for="nombre">Nombre*</label>
    <input type="text" name="nombre" value=<?=$usuario->nombre?> required />
	
	<label for="apellidos">Apellidos*</label>
	<input type="text" name="apellidos"  value=<?=$usuario->apellidos?> required />
	
	<label for="email">Email*</label>
	<input type="email" name="email"  value=<?=$usuario->email?> required />
        
    <label for="dni">DNI</label>
	<input type="number" name="dni" value=<?=$usuario->dni?> />
        
    <label for="telefono">Telefono</label>
	<input type="number" name="telefono" value=<?=$usuario->telefono?> />
        
    <label for="direccion">Direccion</label>
	<input type="text" name="direccion" value=<?=$usuario->direccion?> />

    <label for="provincia">Provincia</label>
    <select name="provincia" id="provincia">
        <?php while ($prov = $provincias->fetch_object()): ?>
            <?php if ($prov->id == $provincia->getId()): ?>
                <option value="<?=$prov->id?>" selected><?=$prov->provincia?></option>
            <?php else :?>
                <option value="<?=$prov->id?>"><?=$prov->provincia?></option>
            <?php endif ?>
        <?php endwhile; ?>
    </select>

    <label for="localidad">Localidad</label>
    <div id="opciones_localidades">
        <select name="localidad" id="localidad">
            <?php while ($loc = $localidades->fetch_object()): ?>
                <?php if ($loc->id == $localidad->getId()): ?>
                    <option value="<?=$loc->id?>" selected><?=$loc->localidad?></option>
                <?php else :?>
                    <option value="<?=$loc->id?>"><?=$loc->localidad?></option>
                <?php endif ?>
            <?php endwhile; ?>
        </select>
    </div>

    <label for="userName">Nombre de Usuario</label>
	<input type="text" name="username" value=<?=$usuario->username?> >

    <p><br>*Los datos con asterisco son obligatorios </p>
	
	<input type="submit" value="Guardar" />
</form>  
<?php endif; ?>
