<h2>List of hikes</h2>

<?php if (!empty($hikes)): ?>
    <ul>
        <?php foreach($hikes as $hike): ?>
            <li>
            <a href="/hike?id=<?= $hike['Hikes_Id'] ?>">
                    <?= $hike['Hikes_Name'] ?><br>
                    Distance: <?= $hike['distance'] ?><br>
                    Duration: <?= $hike['duration'] ?><br>
                    Elevation Gain: <?= $hike['elevation_gain'] ?><br>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

