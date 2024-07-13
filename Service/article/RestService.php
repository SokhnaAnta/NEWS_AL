<?php

require_once(__DIR__ .'/../../modele/domaine/Article.php');
require_once(__DIR__ .'/../../modele/dao/ArticleDAO.php');

$articleDAO = new ArticleDAO();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

switch ($requestMethod) {
    case 'GET':
        handleGETRequest($pathInfo, $articleDAO);
        break;
    default:
        http_response_code(405); 
        break;
}

function handleGETRequest($pathInfo, $articleDAO) {
    $pathSegments = explode('/', $pathInfo);

    // Gestion des différentes routes GET
    switch ($pathSegments[1]) {
        case 'articles':
            handleGetArticles($articleDAO);
            break;
        case 'articlesByCategory':
            handleGetArticlesByCategory($articleDAO, $pathSegments);
            break;
        case 'articlesGroupedByCategory':
            handleGetArticlesGroupedByCategory($articleDAO);
            break;
        default:
            http_response_code(404); // Ressource non trouvée
            break;
    }
}

function handleGetArticles($articleDAO) {
    $format = $_GET['format'] ?? 'json';

    $articles = $articleDAO->getList();
    $articlesArray = array_map(function($article) {
        return $article->toArray();
    }, $articles);

    if ($format === 'xml') {
        header('Content-Type: application/xml');
        $xml = new SimpleXMLElement('<data/>');
        array_to_xml($articlesArray, $xml, 'article');
        echo $xml->asXML();
    } else {
        header('Content-Type: application/json');
        echo json_encode($articlesArray);
    }
}

function handleGetArticlesByCategory($articleDAO, $pathSegments) {
    $format = $_GET['format'] ?? 'json';

    $categoryId = $pathSegments[2] ?? null;

    if ($categoryId === null) {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'Category ID is required']);
        return;
    }

    $articles = $articleDAO->getArticleByCategorie($categoryId);
    $articlesArray = array_map(function($article) {
        return $article->toArray();
    }, $articles);

    if ($format === 'xml') {
        header('Content-Type: application/xml');
        $xml = new SimpleXMLElement('<data/>');
        array_to_xml($articlesArray, $xml, 'article');
        echo $xml->asXML();
    } else {
        header('Content-Type: application/json');
        echo json_encode($articlesArray);
    }
}

function handleGetArticlesGroupedByCategory($articleDAO) {
    $articlesByCategory = $articleDAO->getArticlesGroupedByCategory();

    // Vérifiez si $articlesByCategory est bien un tableau
    if (!is_array($articlesByCategory)) {
        throw new Exception("Expected an array from getArticlesGroupedByCategory, got: " . gettype($articlesByCategory));
    }

    // Transformez les articles JSON en tableaux PHP
    $articlesArray = array_map(function($category) {
        // Décodez la chaîne JSON des articles en tableau PHP
        $articles = json_decode($category['articles'], true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error decoding JSON: " . json_last_error_msg());
        }

        return [
            'categorie' => $category['categorie'],
            'articles' => $articles
        ];
    }, $articlesByCategory);

    $format = $_GET['format'] ?? 'json';

    if ($format === 'xml') {
        header('Content-Type: application/xml');
        $xml = new SimpleXMLElement('<data/>');
        array_to_xml($articlesArray, $xml, 'category');
        echo $xml->asXML();
    } else {
        header('Content-Type: application/json');
        echo json_encode($articlesArray);
    }
}

function array_to_xml($data, &$xml, $itemName) {
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            if (is_numeric($key)) {
                $key = $itemName; // Nommer les éléments numériques
            }
            $subnode = $xml->addChild($key);
            array_to_xml($value, $subnode, $itemName);
        } else {
            $xml->addChild("$key", htmlspecialchars("$value"));
        }
    }
    return $xml;
}
