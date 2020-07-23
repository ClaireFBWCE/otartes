<?php

session_start();

require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';


// vérifier que l'id existe et récupérer l'id d'une pie à afficher
// tester avec url de type : http://localhost/o-tartes?id=quelquechose
// die(var_dump($_GET));

// $id = $_GET['id'];
$productId = checkInGETOrRedirect('productId', 'int');


$productRepo = new ProductRepository();
$oneProduct = $productRepo->getOnePie($productId);

// récupère les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();
$oneUser = $userRepo->getOneUserById($oneProduct['user_id']);
// die(var_dump($oneUser));


// titre de la page
$title = 'Ô Tartes&nbsp;!<br>' .$oneProduct['name'];

// Views dont on a besoin
require('templates\header.phtml');
require('templates\pages\oneProduct.phtml');
require('templates\footer.phtml');