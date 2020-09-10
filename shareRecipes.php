<?php

session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';


$title = "Toutes les recettes de nos membres";


//récupère les produits
$productRepo = new ProductRepository();
$allProductsMembers = $productRepo->getAllProductMember();

// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'shareRecipes.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');

