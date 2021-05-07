<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';

$title = 'Toutes nos Ô Tartes !';  

// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();

// récupérer les  produits
$productRepo = new ProductRepository();
$allProducts = $productRepo->getAllPies();

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'allProducts.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');