<h2>Edit Hike</h2>
        <form action="/edit" method="post">
            <input type="hidden" name="id" value="<?= $data['Hikes_Id'] ?>">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?=$data['Hikes_Name']?>">
            <label for="distance">Distance</label>
            <input type="text" name="distance" id="distance" value="<?=$data['distance']?>">
            <label for="duration">Duration</label>
            <input type="text" name="duration" id="duration" value="<?= $data['duration'] ?>">
            <label for="elevation_gain">Elevation Gain</label>
            <input type="text" name="elevation_gain" id="elevation_gain" value="<?= $data['elevation_gain'] ?>"> 

            <label for="Tags">tags</label>
            <input type="text" name="Tags" id="Tags" value="<?= $data['Tags'] ?>">
             
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" ><?= $data['description'] ?></textarea>
            <button type="submit">SAVE</button>
        </form>
