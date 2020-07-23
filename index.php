<?php
session_start();

require_once 'models/Autoloader.php';

$title = 'Bienvenue sur Ô Tartes&nbsp;!';  


// voir si la session fonctionne bien
// if (isset( $_SESSION['user'])){
//     echo 'ça fonctionne :)';
// } else {
//     echo 'ça ne fonctionne pas !';
// }
// die(var_dump($_GET));

/*// Connexion User
$userRepo = new UserRepository();
$userConnection = $userRepo->userIsConnected();
// $userDisconnected = $userRepo->disconnectUser();
// die(var_dump($userDisconnected));*/

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


// // vérifier que la connection à la bdd fonctionne
// $userConnection = new UserConnection();
// $userConnection->connectUser('test@test.fr', 'testest');

$messageService = new MessageService();

// Views dont on a besoin
require('templates\header.phtml');
require('templates\pages\homepage.phtml');
require('templates\footer.phtml');

$messageService->deleteMessage();


