<?php
session_start();

require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Updater baby !';  

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
require('templates\header.phtml');
require('templates\pages\edit.phtml');
require('templates\footer.phtml');