<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article->titre; ?></title>
</head>
<body>
<?php require_once 'inc/header.php'; ?>
<div class="article">
    <h2><?= $article->titre; ?></h2>
    <p><?= $article->contenu; ?></p>
</div>
<?php require_once 'inc/footer.php'; ?>
</body>
</html>
