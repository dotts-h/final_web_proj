<p>Current number of jokes: <?= $totalJokes ?></p>

<?php foreach ($jokes as $joke) : ?>
    <blockquote>
        <p>
            <?= htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8') ?>

            (by <a class="author" href="mailto:<?php
                                                echo htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php
                echo htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8'); ?>
            </a>)

            <?php
            $date = new DateTime($joke['jokedate']);

            echo $date->format('jS F Y');
            ?>

            <?php if ($userId == $joke['authorId']) : ?>
                <a class="edit" href="/joke/edit?id=<?= $joke['id'] ?>">Edit</a>

        <form action="/joke/delete" method="post">
            <input type="hidden" name="id" value="<?= $joke['id'] ?>">
            <input type="submit" value="Delete">
        </form>
    <?php endif; ?>
    </p>
    </blockquote>
<?php endforeach; ?>