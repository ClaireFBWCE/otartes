<?php
require_once 'models/Autoloader.php';

$title = 'Page Produit baby !';

// echo 'Bienvenue sur la page produit';

// vérifier que l'id existe et récupérer l'id d'une pie à afficher
// tester avec url de tyupe : http://localhost/o-tartes?id=quelquechose
// die(var_dump($_GET));

// $id = $_GET['id'];


if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = 0;
}

$oneProductRepo = new ProductRepository();
$oneProduct = $oneProductRepo->getOnePie($id);

// var_dump($oneProduct);


// Views dont on a besoin
require('templates\header.phtml');
require('templates\pages\oneProduct.phtml');
require('templates\footer.phtml');