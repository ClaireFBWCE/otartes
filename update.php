<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Page d\'update';  

$uploadService = new UploadService();

// verifs
$productId = $_GET['productId'];
$mustImageBeSavedInDB = $uploadService->checkAndUploadFileForRecipeUpdate($productId);

// recap du nom de fichier
$fileName = $_FILES['file']['name'];


// récupérer les données du produit
$productRepo = new ProductRepository();

if(!empty($_POST)){
    
    // récupérer et updater les données
    $productToUpdate = [
        'name' => $_POST['nameRecipe'],
        'image' => $fileName,
        'alt' => $_POST['nameRecipe'],
        'ingredient' => $_POST['ingredients'],
        'recipe' => $_POST['recipe'],
        'baking' => intval($_POST['baking']),
        'mixture' => intval($_POST['mixture']),
        'nb' => intval($_POST['personne']),
        'categoryId' => intval($_POST['categoryId']),
    ];

    //récupérer la fonction qui permet l'ajout
    if ($mustImageBeSavedInDB === true) {
        $productRepo->updateWithNewImage($productToUpdate, $productId);
    } else {
        $productRepo->updateWithoutImage($productToUpdate, $productId);
    }    
}



// rediriger sur la page du membre
$memberId = $_SESSION['user']['id'];

/* autre solution possible mais qui fait un appel inutile à la bdd
    // rediriger sur la page du membre
    $userRepo = new UserRepository();
    $member = $userRepo->getUserIdByProductId($productId); // récupère un tableau
    $memberId = $member['user_id'];
    // die(var_dump($memberId));
*/

header("Location: member.php?memberId=$memberId"); 
die();