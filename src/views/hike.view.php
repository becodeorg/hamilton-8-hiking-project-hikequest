<?= $hike['created_at'] ?><br>
<?= $hike['Hikes_Name'] ?><br>
Distance: <?= $hike['distance'] ?><br>
Duration: <?= $hike['duration'] ?><br>
Elevation Gain: <?= $hike['elevation_gain'] ?><br>
<a href="/edit?id=<?= $hike['Hikes_Id'] ?>">
    <button>Edit</button>
</a>