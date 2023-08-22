<?= $data['created_at'] ?><br>
<?= $data['nickname'] ?><br>
Distance: <?= $data['distance'] ?><br>
Duration: <?= $data['duration'] ?><br>
Elevation Gain: <?= $data['elevation_gain'] ?><br> 
<?php if (isset($_SESSION['user']['username']) && (strtolower($_SESSION['user']['username']) == strtolower($data['nickname']) || strtolower($_SESSION['user']['username']) == "batcave")): ?>
<a href="/edit?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Edit</button></a>
<a href="/delete?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Delete</button></a>
<?php endif ?>