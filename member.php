<?php

session_start();

require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = "Toutes mes recettes 😋";
$memberId = checkInGETOrRedirect('memberId', 'int');


secureUserId($memberId);
// die(var_dump($userId));

// récupère les produits
$productRepo = new ProductRepository();
$memberProducts = $productRepo->getProductByUserID($memberId);

// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();

$messageService = new MessageService();

// Views dont on a besoin
require('templates/header.phtml');
require('templates/pages/member.phtml');
require('templates/footer.phtml');

$messageService->deleteMessage();
