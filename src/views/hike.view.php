<?= $hike['created_at'] ?><br>
<?= $hike['name'] ?><br>
Distance: <?= $hike['distance'] ?><br>
Duration: <?= $hike['duration'] ?><br>
Elevation Gain: <?= $hike['elevation_gain'] ?><br>
<a href="/edit?id=<?= $hike['id'] ?>">
    <button>Edit</button>
</a>