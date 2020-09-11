<?php

session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = "Toutes mes recettes 😋";

// verif member
$memberId = checkInGETOrRedirect('memberId', 'int');
secureUserId($memberId);

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