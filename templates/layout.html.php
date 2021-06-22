<!DOCTYPE html>
<html>

<head>
    <!-- <base href="https://obscure-sands-40037.herokuapp.com/"> -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/jokes.css">
    <title><?= $title ?></title>

    <script>

    </script>
</head>

<body>
    <header>
        <h1>MyJokes Forum</h1>
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
        &copy; Nuță Horia Cătălin [2021]
    </footer>
</body>

</html>