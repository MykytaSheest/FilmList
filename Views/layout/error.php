<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/error/error.css">
    <title> <?php echo $code ?></title>
</head>
<body>
<div class="error_handler">
    <div class="code">
        <?php echo $code ?>
    </div>
    <br>
    <div class="message">
        <?php echo $message ?>
    </div>
    <div class="button">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? getHost() ?>">
            <button>Turn back</button>
        </a>
    </div>
</div>

</body>
</html>
