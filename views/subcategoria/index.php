<h1>Gestionar Subcategorias</h1>

<a href="<?=base_url?>subcategoria/crear" class="button button-small">
    Crear Subcategoria
</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
    </tr>
    <?php while($cat = $subcategorias->fetch_object()): ?>
        <tr>
            <td><?=$cat->id;?></td>
            <td><?=$cat->nombre;?></td>
        </tr>
    <?php endwhile; ?>
</table>
