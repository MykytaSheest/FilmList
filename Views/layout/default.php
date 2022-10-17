<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo $title ?></title>
    <link rel="stylesheet" href="../../public/css/film/main.css">
    <link rel="stylesheet" href="../../public/css/user/auth.css">
    <link rel="stylesheet" href="../../public/css/film/form.css">
    <link rel="stylesheet" href="../../public/css/film/upload.css">
</head>
<body>
    <header>
        <div>
            <h1>My Films</h1>
        </div>
    </header>
    <div class="logout">
        <?php if (!empty($_SESSION['token'])): ?>
            <a href="<?= getHost() ?>/logout">
                <button>Logout</button>
            </a>
        <?php endif; ?>

    </div>
    <main class="main-content">
        <?php echo $content ?>
    </main>
</body>
</html>
