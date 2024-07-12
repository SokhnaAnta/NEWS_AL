<<<<<<< Updated upstream
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
=======
<?php
require_once 'controller/Controller.php';
require_once 'controller/AuthController.php';
require_once 'controller/ArticleController.php';
require_once 'controller/CategorieController.php';

session_start(); 
$controller = new Controller();
$authController = new AuthController();
$articleController = new ArticleController() ;
$action = isset($_GET['action']) ? strtolower($_GET['action']) : '';
$categorieController = new CategorieController() ;

switch ($action) {
    case '':
        $controller->accueil();
        break;
    case 'article':
        if (isset($_GET['id'])) {
            $controller->article($_GET['id']);
        } else {
            $controller->showErrorPage();
        }
        break;
    case 'categorie':
        if (isset($_GET['id'])) {
            $controller->categorie($_GET['id']);
        } else {
            $controller->showErrorPage();
        }
        break;
    case 'login':
        $authController->login();
        break;
    case 'authenticate':
        $authController->authenticate();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'list_articles':
        $articleController->listArticles();
        break ;
    case 'add_article':
        $articleController->addArticle();
        break ;
     case 'update_article':
        $articleController->editArticle($_REQUEST['id']);
        break ;
     case 'delete_article':
        $articleController->deleteArticle($_REQUEST['id']);
        break ;
    case 'list_categories':
        $categorieController->listCategories();
        break ;
    case 'add_categorie':
        $categorieController->addcategorie();
        break ;
    case 'edit_categorie':
        $categorieController->editcategorie($_REQUEST['id']);
        break ;
    case 'delete_categorie':
        $categorieController->deletecategorie($_REQUEST['id']);
        break ;
        case 'list_utilisateurs':
            $authController->listUtilisateurs();
            break ;
        case 'add_utilisateur':
            $authController->addUtilisateur();
            break ;
        case 'edit_utilisateur':
            $authController->editUtilisateur($_REQUEST['id']);
            break ;
        case 'delete_utilisateur':
            $authController->deleteUtilisateur($_REQUEST['id']);
            break ;
    default:
        $controller->ShowErrorPage();
        break;
}
>>>>>>> Stashed changes
