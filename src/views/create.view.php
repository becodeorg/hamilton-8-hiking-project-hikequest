<h2>Edit Hike</h2>

<form action="#" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" >
        <label for="distance">Distance</label>
        <input type="text" name="distance" id="distance" >
        <label for="duration">Duration</label>
        <input type="time" name="duration" id="duration">
        <label for="elevation_gain">Elevation Gain</label>
        <input type="text" name="elevation_gain" id="elevation_gain" >
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10">Enter description</textarea>

        <?php foreach ($tags as $tag): ?>
        <input type="checkbox" name="tags_add[]" id="<?= $tag['Tags_Name'] ?>" value="<?= $tag['Tags_Id'] ?>">
        <label for="<?= $tag['Tags_Name'] ?>"><?= $tag['Tags_Name'] ?></label>
        <?php endforeach ?>
        
        <button type="submit">SAVE</button>
    </form>

