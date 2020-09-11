<?php

session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Bienvenue sur Ô Tartes&nbsp;!';  

// Connexion User
$userRepo = new UserRepository();
$connectionService = new ConnectionService();
$userConnection = $connectionService->isUserConnected();

// récupérer les users
$userRepo = new UserRepository();
$allUsers = $userRepo->getAllUsers();

// récupérer les  produits
$productRepo = new ProductRepository();
$allproducts = $productRepo->getAllPies();
$recentProducts = $productRepo->get6RecentPies();
$saltedProducts = $productRepo->get3SaltedPies();
$sweetProducts = $productRepo->get3SweetPies();

$messageService = new MessageService();

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'homepage.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');

$messageService->deleteMessage();