<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESP NEWS</title>
</head>
<body>
<?php require_once 'inc/header.php'; ?>
<div class="articles">
    <?php if (empty($articles)) : ?>
        <p>Aucun article trouvé pour cette categorie.</p>
    <?php else : ?>
        <?php foreach ($articles as $article) : ?>
            <div class="article">
                <h2><a href="index.php?action=article&id=<?= $article->id; ?>"><?= $article->titre; ?></a></h2>
                <p><?= $article->contenu; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php require_once 'inc/footer.php'; ?>
</body>
</html>
