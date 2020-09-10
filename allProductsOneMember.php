<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';


$title = 'Tous les produits d\'un membre';  

$memberId = checkInGETOrRedirect('memberId', 'int');

// die(var_dump($_GET));


// récupère les produits
$productRepo = new ProductRepository();
$memberProducts = $productRepo->getProductByUserID($memberId);
// $memberName = $productRepo->getProductByUserID($id['firstname']);


// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();
$oneUser = $userRepo->getOneUserById($memberId);


// die(var_dump($memberProducts));
// $allProductsOneMember = $productRepo->getProductByUserFirstname($userFirstname);


// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'allProductsOneMember.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');