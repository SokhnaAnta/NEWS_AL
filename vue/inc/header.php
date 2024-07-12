<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.article').hide().fadeIn(1000);
    });
    </script>

    
</head>
<body>
<h1>POLYTECHNIC NEWS</h1>
<div class="navbar">
    <a href="index.php">Accueil</a>
    <?php if( isset($_SESSION['user_id'])){ ?>
    <a href="index.php?action=list_articles">Articles</a>
    <a href="index.php?action=list_categories">Catégories</a>
    <?php if ($_SESSION['role'] == "administrateur"){ ?>
    <a href="index.php?action=list_utilisateurs">Utilisateurs</a>
     <?php } ?>
    <a href="index.php?action=logout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
    <path fill="currentColor" d="M13 3c1.1 0 2 .9 2 2v3h-2V5h-4v14h4v-3h2v3c0 1.1-.9 2-2 2h-4c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h4zm5.59 4.59L18 7l-5 5 5 5 1.41-1.41L16.83 13H23v-2h-6.17l1.76-1.76z"/>
    </svg>
    </a>
    <?php } else {?>
    <a href="index.php?action=login">Login</a>
    <?php foreach ($categories as $categorie) : ?>
        <a href="index.php?action=categorie&id=<?= $categorie->id; ?>"><?= $categorie->libelle; ?></a>
    <?php endforeach; ?>
    <?php } ?>

   
</div>
