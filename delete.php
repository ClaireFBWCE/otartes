<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Page suppression';  

$product_id = $_GET['productId'];

// récupère les produits
$productRepo = new ProductRepository();
$deleteProduct = $productRepo->delete($product_id);

// rediriger sur la page précédente
$redirect = $_SERVER['HTTP_REFERER'];

header("Location: $redirect"); 
die();