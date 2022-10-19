<script src="../../public/js/upload_films.js" defer></script>

<div class="upload-form">
    <form action="<?= getHost() ?>/film/file" method="post" class="form-upload-film" enctype="multipart/form-data">
        <h5>Upload file with film</h5>
        <pre>
        Only .txt extension
        Structure file:
            Title:
            Release Year:
            Format:
            Stars:
        </pre>
        <input type="file" name="file" class="file-input" accept=".txt" required>
        <button type="submit" class="save-form">Send</button>
    </form>
</div>

