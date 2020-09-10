<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';


// var_dump($_GET);

// on vérifie que c'est pas une url du type "allCategoryProducts.php" ou "allCategoryProducts.php?category_id=4"
if(!isset($_GET['category_id']) ||  !in_array($_GET['category_id'], ['1', '2'])) {
    header("Location: index.php");
    die();
}

$category_id = $_GET['category_id'];

// on assigne le titre en fonction de la catégory_id
if($category_id === '1') {
    $title = 'Toutes nÔs Tartes! salées';  
} elseif(($category_id === '2')) {
    $title = 'Toutes nÔs Tartes! sucrées';  
}

// récupérer les produits
$productRepo = new ProductRepository();
$allCategoryProducts = $productRepo->getProductByCategory($category_id);


// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();


// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'allCategoryProducts.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');


