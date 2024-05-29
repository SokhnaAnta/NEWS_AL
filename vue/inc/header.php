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
    <?php foreach ($categories as $categorie) : ?>
        <a href="index.php?action=categorie&id=<?= $categorie->id; ?>"><?= $categorie->libelle; ?></a>
    <?php endforeach; ?>
</div>
