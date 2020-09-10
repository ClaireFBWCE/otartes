<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Modifier ma recette';  

// die(var_dump($_GET));
$product_id = $_GET['productId'];

// récupère 1 produit pour préremplir le form
$productRepo = new ProductRepository();
$editProduct = $productRepo->getOnePie($product_id);

// die(var_dump($editProduct));

// // rediriger sur la page précédente
// $redirect = $_SERVER['HTTP_REFERER'];

// header("Location: $redirect"); 
// die();

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'edit.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');