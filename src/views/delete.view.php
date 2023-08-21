<h1>Delete Hike</h1>

<p>Are you sure you want to delete this hike : <?= $data['Hikes_Name'] ?> ?</p>

<form action="#" method="post">
    <input type="hidden" name="Hikes_Id" value="<?= $data['Hikes_Id'] ?>">
    <button type="submit">Delete Hike</button>
</form>
