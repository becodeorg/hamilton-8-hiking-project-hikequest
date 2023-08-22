<h2 class="title_edit_page">Edit Hike</h2>
<?php if (!empty($hike)): ?>
    <div class="container_content_edit_page">
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
            <textarea name="description" id="description" cols="30" rows="3" ><?= $hike['description'] ?></textarea>
            <div class="container_checkbox_form_edit_page">
                <div class="tags_lied_edit_page">
                    <?php if (empty($tagsChecked)): ?>
                    <?php else: ?>
                    <label class="lied" for="tags_lied">Tags déjà choisi:</label>
                    <br>
                    <?php foreach($tagsChecked as $tag): ?>
                        <div class="tags_container_edit_page">
                            <input type="checkbox" name="tags_lied[<?= $tag['Tags_Id'] ?>]" id="tags_lied_<?= $tag['Tags_Id'] ?>" value="<?= $tag['Tags_Id'] ?>" checked>
                            <label for="tags_lied_<?= $tag['Tags_Id'] ?>"><?= $tag['Tags_Name'] ?></label>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="tags_not_lied_edit_page">
                    <label class="not_lied" for="tags_not_lied">Tags non choisi:</label>
                    <?php foreach($tagsNotLied as $tag): ?>
                    <div class="tags_container_not_lied_edit_page">
                        <input type="checkbox" name="tags_not_lied[<?= $tag['Tags_Id'] ?>]" id="tags_not_lied_<?= $tag['Tags_Id'] ?>" value="<?= $tag['Tags_Id'] ?>" >
                        <label for="tags_not_lied_<?= $tag['Tags_Id'] ?>"><?= $tag['Tags_Name'] ?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="btn_save_edit_page">
                <button type="submit">SAVE</button>
            </div>
        </form>
    </div>
<?php endif; ?>
