<?php include 'news.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGSLI News</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.article').hide().fadeIn(1000);
    });
    </script>

</head>
<body>
    <h1> POLYTECHNIC NEWS</h1>
    <div class="navbar">
        <a href="index.php">Accueil</a>
        <?php
        $sql = "SELECT * FROM Categorie";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<a href="index.php?categorie=' . $row["id"] . '">' . $row["libelle"] . '</a>';
            }
        }
        ?>
    </div>

    <div class="articles">
        <?php
        $sql = "SELECT * FROM Article";
        if (isset($_GET['categorie'])) {
            $sql .= " WHERE categorie = " . $_GET['categorie'];
        }
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($article = $result->fetch_assoc()) {
                echo '<div class="article">';
                echo '<h2>' . $article["titre"] . '</h2>';
                echo '<p>' . $article["contenu"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucun article trouvé.</p>";
        }
        ?>
    </div>
</body>
</html>
