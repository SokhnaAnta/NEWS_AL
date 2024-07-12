<?php
require_once(__DIR__ .'/../../modele/domaine/User.php');
require_once(__DIR__ .'/../../modele/dao/UserDAO.php');

require_once('SoapService.php');


// Créer un serveur SOAP et ajouter les fonctions
$server = new SoapServer(null, array('uri' => "http://localhost/NEWS_AL/Service/user"));

$server->setClass('SoapService');
// Gérer la requête SOAP
$server->handle();
