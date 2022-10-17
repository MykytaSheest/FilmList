<script src="../../public/js/delete_film.js" defer></script>

<div class="film-container">
    <div class="add-film">
        <a href="film/create">
            <button>Add film</button>
        </a>
    </div>

    <div class="films">

        <?php if (sizeof($films)): ?>
            <div class="search-block">
                <div>
                    <input type="text" placeholder="Search by title">
                    <a href="">
                        <input type="button" value="Search">
                    </a>
                </div>
                <div>
                    <input type="text" placeholder="Search by actor">
                    <a href="">
                        <input type="button" value="Search">
                    </a>
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
                        <td><p><?= $film['id'] ?></p></td>
                        <td><p><?= $film['title'] ?></p></td>
                        <td><?= $film['year'] ?></td>
                        <td><?= $film['format_title'] ?></td>
                        <td><?= implode(', ', $film['actors']) ?></td>
                        <td>
                            <button class="delete-button" value="<?= $film['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

    </div>
</div>

