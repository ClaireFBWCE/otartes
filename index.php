<?php
session_start();

require_once 'models/Autoloader.php';

$title = 'Ô Tartes !';  


// voir si la session fonctionne bien
// if (isset( $_SESSION['user'])){
//     echo 'ça fonctionne :)';
// } else {
//     echo 'ça ne fonctionne pas !';
// }
// die(var_dump($_GET));



$productRepo = new ProductRepository();
$allproducts = $productRepo->getAllPies();

$recentProducts = $productRepo->get3RecentPies();

$saltedProducts = $productRepo->get3SaltedPies();
// die(var_dump($saltedProducts));

$sweetProducts = $productRepo->get3SweetPies();

// die(var_dump($oneProduct));
// $checkIfImageExists = $productRepo->checkImage('image');


// // vérifier que la connection à la bdd fonctionne
// $userConnection = new UserConnection();
// $userConnection->connectUser('test@test.fr', 'testest');

// Views dont on a besoin
require('templates\header.phtml');
require('templates\pages\homepage.phtml');
require('templates\footer.phtml');


