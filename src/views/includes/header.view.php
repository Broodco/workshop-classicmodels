<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classic Models</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <?php if (empty($_SESSION['user'])): ?>
                <li><a href="/login">Login</a></li>
                <li><a href="/registration">Register</a></li>
            <?php else: ?>
                <li><a href="/logout">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <?php if (!empty($_SESSION['user'])): ?>
        <span>Hello <?= $_SESSION['user']['username'] ?></span>
    <?php endif; ?>
</header>

<h1>Classic Models</h1>