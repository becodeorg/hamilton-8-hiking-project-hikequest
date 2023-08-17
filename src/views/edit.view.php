<h2>Edit Hike</h2>
<?php print_r($_GET)?>
<?php var_dump($_GET)?>
<?php if (!empty($hike)): ?>
        <form action="/edit?id=<?= $hike['Hikes_Id'] ?>" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?=$hike['Hikes_Name']?>">
            <label for="distance">Distance</label>
            <input type="text" name="distance" id="distance" value="<?=$hike['distance']?>">
            <label for="duration">Duration</label>
            <input type="text" name="duration" id="duration" value="<?= $hike['duration'] ?>">
            <label for="elevation_gain">Elevation Gain</label>
            <input type="text" name="elevation_gain" id="elevation_gain" value="<?= $hike['elevation_gain'] ?>">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" ><?= $hike['description'] ?></textarea>
            <label for="tags">Tags</label>
            <?php foreach($tags as $tag): ?>
                <input type="checkbox" name="tags_choice" id="tags" value="<?= $tag['Tags_Id'] ?>">
                <label for="tags"><?= $tag['Tags_Name'] ?></label>
            <?php endforeach; ?>
            <button type="submit">SAVE</button>
        </form>
<?php endif; ?>

