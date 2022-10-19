<script src="../../public/js/add_film.js" defer></script>
<script src="../../public/js/validator_form.js" defer></script>

<form action="<?= getHost()?>/post/create" METHOD="post" class="form-add-film">
    <input type="text" name="title" class="film-input title" placeholder="Film title..." required>
    <input type="number" title="You can choose years between 1850 and 2022" name="year" class="film-input year"  placeholder="Film year between 1850 and 2022..." min="1850" max=2022 required>
    <select name="format" class="format">
        <option value="1">VHS</option>
        <option value="2">DVD</option>
        <option value="3">Blu-ray</option>
    </select>
    <div class="actors">
    </div>
    <div class="actor-input">
        <input type="text" name="actor" class="film-input field-actor" placeholder="add actor...">
        <input type="button" class="add-actor-button film-input" value="add">
    </div>

    <input type="submit" class="film-input save-form" value="Save">

    <a href="<?= getHost() ?>/film/file">
        Upload file with films
    </a>
</form>



<?php
