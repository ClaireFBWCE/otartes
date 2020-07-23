<?php

session_start();

require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';


$title = "Toutes les recettes partagées baby !";


//récupère les produits
$productRepo = new ProductRepository();
$allProductsMembers = $productRepo->getAllProductMember();

// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();

// Views dont on a besoin
require('templates/header.phtml');
require('templates/pages/shareRecipes.phtml');
require('templates/footer.phtml');

