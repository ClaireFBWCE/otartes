<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Modifier ma recette';  

$product_id = $_GET['productId'];

// récupère 1 produit pour préremplir le form
$productRepo = new ProductRepository();
$editProduct = $productRepo->getOnePie($product_id);

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'edit.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');