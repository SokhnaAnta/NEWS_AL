<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link CSS personnalisé -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un article</h2>
        <form action="index.php?action=update_article&id=<?php echo $article->id; ?>" method="POST">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" class="form-control" value="<?php echo htmlspecialchars($article->titre); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" class="form-control" rows="6" required><?php echo htmlspecialchars($article->contenu); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select id="categorie" name="categorie" class="form-control" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie->id; ?>" <?php if ($categorie->id == $article->categorie) echo 'selected'; ?>><?php echo htmlspecialchars($categorie->libelle); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
