<select name="localidad" id="localidad">
    <?php while ($loc = $loc_filtradas->fetch_object()): ?>
        <option value="<?=$loc->id?>"><?=$loc->localidad?></option>
    <?php endwhile; ?>
</select>
