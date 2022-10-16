<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo $title ?></title>
    <script src="../../public/js/auth_headers.js"></script>
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/auth.css">
</head>
<body>
    <header>
        <div>
            <h1>Film List</h1>
        </div>
    </header>
    <div class="logout">
        <?php if (!empty($_SESSION['token'])): ?>
            <a href="logout">
                <button>Logout</button>
            </a>
        <?php endif; ?>

    </div>
    <main class="main-content">
        <?php echo $content ?>
    </main>
</body>
</html>
