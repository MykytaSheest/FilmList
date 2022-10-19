<script src="../../public/js/delete_film.js" defer></script>

<div class="film-container">
    <div class="add-film">
        <a href="<?= getHost()?>/film/create">
            <button>Add film</button>
        </a>
    </div>
    <div class="add-film">
        <a href="<?= getHost()?>">
            <button>Main page</button>
        </a>
    </div>

    <div class="films">
        <?php if (sizeof($films)): ?>
            <div class="search-block">
                <div>
                    <form action="<?= getHost()?>/film/search" method="post">
                        <input type="text" name="title" class="input-search-by-title" placeholder="Search by title">
                        <input type="submit" class="button-search-by-title" value="Search">
                    </form>
                </div>
                <div>
                    <form action="<?= getHost()?>/film/search" method="post">
                        <input type="text" name="actor" class="input-search-by-title" placeholder="Search by actor">
                        <input type="submit" class="button-search-by-title" value="Search">
                    </form>
                </div>
            </div>
            <table class="film-table">
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Format</th>
                    <th>Actors</th>
                </tr>
                <?php foreach ($films as $film): ?>
                    <tr>
                        <td><p><?= htmlspecialchars($film['id']) ?></p></td>
                        <td><p><?= htmlspecialchars($film['title']) ?></p></td>
                        <td><?= htmlspecialchars($film['year']) ?></td>
                        <td><?= htmlspecialchars($film['format_title']) ?></td>
                        <td><?= htmlspecialchars(implode(', ', $film['actors'])) ?></td>
                        <td>
                            <button class="delete-button" value="<?= $film['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>
</div>

