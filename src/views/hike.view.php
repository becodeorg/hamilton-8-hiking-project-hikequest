<<<<<<< HEAD
<?= $hike['created_at'] ?><br>
<?= $hike['Hikes_Name'] ?><br>
Distance: <?= $hike['distance'] ?><br>
Duration: <?= $hike['duration'] ?><br>
Elevation Gain: <?= $hike['elevation_gain'] ?><br>
<a href="/edit?id=<?= $hike['Hikes_Id'] ?>">
    <button>Edit</button>
</a>
=======
<?= $data['created_at'] ?><br>
<?= $data['nickname'] ?><br>
Distance: <?= $data['distance'] ?><br>
Duration: <?= $data['duration'] ?><br>
Elevation Gain: <?= $data['elevation_gain'] ?><br> 
<a href="/edit?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Edit</button></a>
<a href="/delete?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Delete</button></a>
>>>>>>> development
