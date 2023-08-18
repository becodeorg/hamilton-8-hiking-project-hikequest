<h2>List of hikes</h2>

<form method="get" action="">
    <select name="select_tags" id="select_tags" onchange="this.form.submit()">
        <option value="all">All</option>
        <?php foreach($tags as $tag): ?>
            <option value="<?= $tag['Tags_Name'] ?>" <?= ($_GET['select_tags'] == $tag['Tags_Name']) ? 'selected' : '' ?>>
                <?= $tag['Tags_Name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if (!empty($datas)): ?>
    <ul>
        <?php foreach($datas as $data): ?>
            <?php if ($_GET['select_tags'] == 'all' || strpos($data['Tags'], $_GET['select_tags']) !== false): ?>
                <li>
                    <a href="/hike?Hikes_Id=<?= $data['Hikes_Id'] ?>">
                        <?= $data['nickname'] ?><br>
                        Distance: <?= $data['distance'] ?><br>
                        Duration: <?= $data['duration'] ?><br>
                        Elevation Gain: <?= $data['elevation_gain'] ?><br>
                        Tags: <?= $data['Tags'] ?><br>
                        <?php if (isset($_SESSION['user']['username']) && strtolower($_SESSION['user']['username']) == strtolower($data['nickname'])): ?>
                            <a href="/edit?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Edit</button></a>
                            <button>Delete</button>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
