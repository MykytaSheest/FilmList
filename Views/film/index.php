<div>
    <a href="film/create">
        <button>Add film</button>
    </a>
</div>

<div class="films">

<?php if (sizeof($films)): ?>
    <table>
        <tr>
            <th>Title</th>
            <th>Year</th>
            <th>Format</th>
            <th>Actors</th>
        </tr>
        <?php foreach ($films as $film): ?>
        <tr>
            <td><p><?= $film['title'] ?></p></td>
            <td><?= $film['year'] ?></td>
            <td><?= $film['format_title'] ?></td>
            <td><?= implode(', ', $film['actors']) ?></td>
            <td><button>Delete</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</div>
