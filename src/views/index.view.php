<?php
$selectedTag = isset($_GET['select_tags']) ? $_GET['select_tags'] : 'all';
?>

    <h2>List of hikes</h2>

    <form method="get" action="">
        <select name="select_tags" id="select_tags" onchange="this.form.submit()">
            <option value="all" <?= ($selectedTag == 'all') ? 'selected' : '' ?>>All</option>
            <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag['Tags_Name'] ?>" <?= ($selectedTag == $tag['Tags_Name']) ? 'selected' : '' ?>>
                    <?= $tag['Tags_Name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

<?php if (!empty($datas)): ?>
    <ul>
        <?php foreach ($datas as $data): ?>
            <?php if (!empty($data['nickname'] && $data['Hikes_Name'])): ?>
                <?php if ($selectedTag == 'all' || (isset($data['Tags']) && strpos($data['Tags'], $selectedTag) !== false)): ?>
                    <li>
                        <a href="/hike?Hikes_Id=<?= $data['Hikes_Id'] ?>">
                            <?= $data['nickname'] ?><br>
                            Hike: <?= $data['Hikes_Name'] ?><br>
                            Distance: <?= $data['distance'] ?><br>
                            Duration: <?= $data['duration'] ?><br>
                            Elevation Gain: <?= $data['elevation_gain'] ?><br>
                            Tags: <?= $data['Tags'] ?><br></a>
                        <?php if (isset($_SESSION['user']['username']) && (strtolower($_SESSION['user']['username']) == strtolower($data['nickname']) || strtolower($_SESSION['user']['username']) == "batcave")): ?>
                            <a href="/edit?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Edit</button></a>
                            <a href="/delete?Hikes_Id=<?= $data['Hikes_Id'] ?>"><button>Delete</button></a>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>