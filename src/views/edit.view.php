<h2>Edit Hike</h2>
<?php if (!empty($hike)): ?>
        <form action="/edit?id=<?= $hike['id'] ?>" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?=$hike['name']?>">
            <label for="distance">Distance</label>
            <input type="text" name="distance" id="distance" value="<?=$hike['distance']?>">
            <label for="duration">Duration</label>
            <input type="text" name="duration" id="duration" value="<?= $hike['duration'] ?>">
            <label for="elevation_gain">Elevation Gain</label>
            <input type="text" name="elevation_gain" id="elevation_gain" value="<?= $hike['elevation_gain'] ?>">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" ><?= $hike['description'] ?></textarea>
            <button type="submit">SAVE</button>
        </form>
<?php endif; ?>

