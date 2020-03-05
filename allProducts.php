<?php
session_start();

require_once 'models/Autoloader.php';

$title = 'Tous les produits baby !';  

$productRepo = new ProductRepository();
$allProducts = $productRepo->getAllPies();

$oneSpecificProduct = $productRepo->getOnePie(3);
var_dump($allProducts[2]);

// Views dont on a besoin
require('templates\header.phtml');
require('templates\pages\allProducts.phtml');
require('templates\footer.phtml');


