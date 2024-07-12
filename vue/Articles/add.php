<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un article</h2>
        <form action="index.php?action=add_article" method="POST">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" class="form-control" rows="6" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select id="categorie" name="categorie" class="form-control" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie->id; ?>"><?php echo $categorie->libelle; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
