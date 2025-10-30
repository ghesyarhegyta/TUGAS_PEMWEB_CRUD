<?php
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CRUD App</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header class="topbar">
        <div class="topbar-inner">
            <h1>CRUD Sederhana</h1>
        </div>
    </header>
    <main class="container">
        <?php
        require_once __DIR__ . '/functions.php';
        $flash = get_flash();
        if ($flash):
        ?>
            <div class="flash <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
        <?php endif; ?>