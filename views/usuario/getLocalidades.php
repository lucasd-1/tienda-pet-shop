<select name="localidad" id="localidad">
    <?php while ($loc = $loc_filtradas->fetch_object()): ?>
        <option value="<?=$loc->localidad?>"><?=$loc->localidad?></option>
    <?php endwhile; ?>
</select>
