<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
      a, a:visited, a:hover, a:active {
    text-decoration: none;
      }
</style>
<body>
<div class="articles">
    <?php if (empty($articles)) : ?>
        <p>Aucun article trouvé pour cette categorie.</p>
    <?php else : ?>
        <?php foreach ($articles as $article) : ?>
            <div class="article">
                <h2><a href="index.php?action=article&id=<?= $article->id; ?>"><?= $article->titre; ?></a></h2>
                <p><?= substr($article->contenu, 0, 150); ?>...</p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
