<?php

session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = "Toutes mes recettes 😋";

// die(var_dump($_SESSION));

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
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'member.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');

$messageService->deleteMessage();
