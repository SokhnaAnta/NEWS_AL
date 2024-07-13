<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESP NEWS</title>
    <style>
        a, a:visited, a:hover, a:active {
    text-decoration: none;
      }


    </style>
</head>
<body>
<div class="articles">
    <?php if (empty($articles)) : ?>
        <p>Aucun article trouvé pour cette categorie.</p>
    <?php else : ?>
        <?php foreach ($articles as $article) : ?>
            <div class="article">
                <h2><a href="index.php?action=article&id=<?= htmlspecialchars($article->id); ?>"><?= htmlspecialchars($article->titre); ?></a></h2>
                <p class="date"><?= htmlspecialchars(date('d F Y', strtotime($article->dateCreation)), ENT_QUOTES, 'UTF-8'); ?></p>
                <p><?= htmlspecialchars(substr($article->contenu, 0, 150)); ?>...</p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="index.php?page=<?= $currentPage - 1; ?>">&laquo; Précédent</a>
    <?php endif; ?>
    <?php if ($currentPage < $totalPages): ?>
        <a href="index.php?&page=<?= $currentPage + 1; ?>">Suivant &raquo;</a>
    <?php endif; ?>
</div>
</body>
</html>
