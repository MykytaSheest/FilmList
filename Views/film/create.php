<script src="../../public/js/add_film.js" defer></script>
<form action="<?= getHost()?>/post/create" METHOD="post" class="form-add-film">
    <input type="text" name="title" class="film-input title" placeholder="Film title..." required>
    <input type="number" name="year" class="film-input year" placeholder="Film year..." min="1870" required>
    <select name="format" class="format">
        <?php foreach ($formats->findAll() as $format): ?>
            <option value="<?= $format['id']?>"><?= $format['title']?></option>
        <?php endforeach; ?>
    </select>
    <div class="actors">
    </div>
    <div class="actor-input">
        <input type="text" name="actor" class="film-input field-actor" placeholder="add actor...">
        <input type="button" class="add-actor-button film-input" value="add">
    </div>

    <input type="submit" class="film-input save-form" value="Save">

</form>

<?php
