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
            handleGetArticles($articleDAO, $pathSegments);
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

function handleGetArticles($articleDAO, $pathSegments) {
    $format = $_GET['format'] ?? 'json';

    $articles = $articleDAO->getList();

    if ($format === 'xml') {
        header('Content-Type: application/xml');
        echo array_to_xml($articles, new SimpleXMLElement('<data/>'))->asXML();
    } else {
        header('Content-Type: application/json');
        echo json_encode($articles);
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

    if ($format === 'xml') {
        header('Content-Type: application/xml');
        echo array_to_xml($articles, new SimpleXMLElement('<data/>'))->asXML();
    } else {
        header('Content-Type: application/json');
        echo json_encode($articles);
    }
}

function handleGetArticlesGroupedByCategory($articleDAO) {
    $articlesByCategory = $articleDAO->getArticlesGroupedByCategory();

    $format = $_GET['format'] ?? 'json';

    if ($format === 'xml') {
        header('Content-Type: application/xml');
        echo array_to_xml($articlesByCategory, new SimpleXMLElement('<data/>'))->asXML();
    } else {
        header('Content-Type: application/json');
        echo json_encode($articlesByCategory);
    }
}

function array_to_xml($array, &$xml) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            if (!is_numeric($key)) {
                $subnode = $xml->addChild("$key");
                array_to_xml($value, $subnode);
            } else {
                array_to_xml($value, $xml);
            }
        } else {
            $xml->addChild("$key", htmlspecialchars("$value"));
        }
    }
    return $xml;
}
