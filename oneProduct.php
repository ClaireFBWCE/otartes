<?php

session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

// récupérer les produits
$productId = checkInGETOrRedirect('productId', 'int');
$productRepo = new ProductRepository();
$oneProduct = $productRepo->getOnePie($productId);

// récupère les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();
$oneUser = $userRepo->getOneUserById($oneProduct['user_id']);

// titre de la page
$title = 'Ô Tartes&nbsp;!<br>' .utf8_encode($oneProduct['name']);

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'oneProduct.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');