<div class="upload-form">
    <form action="<?= getHost() ?>/film/file" method="post" enctype="multipart/form-data">
        <h5>Upload file with film</h5>
        <pre>
        Only .txt extension
        Structure file:
            Title:
            Release Year:
            Format:
            Stars:
        </pre>
        <input type="file" name="file" accept=".txt" required>
        <button type="submit">Send</button>
    </form>
</div>

