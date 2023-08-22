<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>HikeQuest</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/"><strong>HikeQuest</strong></a></li>
            </ul>
            <ul>
                <?php if (!empty($_SESSION['user'])): ?>
                    <p><a href="/profil">Bonjour <?= $_SESSION['user']['username'] ?></a></p>
                    <li><a href="/logout">Logout</a></li>
                    <li class="blueButton"><a href="/Add">Add new Hike</a></li>
                <?php else: ?>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
