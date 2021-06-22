<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="jokes.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <h1>Internet Joke Database</h1>
        <?php
        echo __DIR__;
        ?>
    </header>
    <nav>
        <ul>
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="/joke/list">Jokes</a>
            </li>
            <li>
                <a href="/joke/edit">Add a new joke</a>
            </li>

            <?php if ($loggedIn) : ?>
                <li><a href="/logout">Log out</a></li>
            <?php else : ?>
                <li><a href="/login">Log in</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>
        &copy; IJDB 2021
    </footer>
</body>

</html>