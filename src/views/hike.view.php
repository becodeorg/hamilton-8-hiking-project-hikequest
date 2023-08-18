<?= $data['created_at'] ?><br>
<?= $data['nickname'] ?><br>
<?= $data['Hikes_Name'] ?><br>
Distance: <?= $data['distance'] ?><br>
Duration: <?= $data['duration'] ?><br>
Elevation Gain: <?= $data['elevation_gain'] ?><br>
<?php if (isset($_SESSION['user']['username']) && strtolower($_SESSION['user']['username']) == strtolower($data['nickname'])): ?>
<a href="/edit?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Edit</button></a>
<button>Delete</button>
<?php endif; ?>