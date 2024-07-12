<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des articles</title>
    <style>
     a {
    text-decoration: none;
    color: inherit;
    }

    a:hover, a:focus, a:active, a:visited {
        text-decoration: none;
        color: inherit;
    }

    </style>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Link CSS personnalisé -->
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <div class="container mt-5">
        <a href="index.php?action=add_article" class="btn btn-primary mb-3">Ajouter un article</a>
        <div class="row">
            <?php foreach ($articles as $article): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title"><a href="index.php?action=article&id=<?= $article->id; ?>"><?php echo htmlspecialchars($article->titre); ?></a></h3>
                            <p class="card-text"><?php echo htmlspecialchars(substr($article->contenu, 0, 100)); ?>...</p>
                            <p class="card-text"><strong>Catégorie: </strong>
                                <?php
                                foreach ($categories as $categorie) {
                                    if ($categorie->id == $article->categorie) {
                                        echo htmlspecialchars($categorie->libelle);
                                        break;
                                    }
                                }
                                ?>
                            </p>
                            <p class="card-text"><strong>Date de création: </strong><?php echo htmlspecialchars($article->dateCreation); ?></p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a href="index.php?action=update_article&id=<?php echo $article->id; ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <a href="index.php?action=delete_article&id=<?php echo $article->id; ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Link Bootstrap JS and Popper.js (required for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
