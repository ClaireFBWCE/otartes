<?php
session_start();

require_once 'models/Autoloader.php';
require_once 'models/FunctionService.php';

$title = 'Updater baby !';  

$uploadService = new UploadService();

// $uploadService->checkUploadedFileType();
// $destinationPath = $uploadService->getUploadedFile();

// /* vérifier le fichier uploadé */
// // var_dump($_FILES);
// // die(var_dump($uploadService));

// /* vérifier si champs bien un 'integer' */
// $checkField = $uploadService->checkIfFieldIsNumeric();
// // die(var_dump($checkField));
// die(var_dump($_FILES));


$productId = $_GET['productId'];

$mustImageBeSavedInDB = $uploadService->checkAndUploadFileForRecipeUpdate($productId);
/* récap du fichier uploadé */
$fileName = $_FILES['file']['name'];

// /* récupérer id du produit */

/* récupérer les données du produit */
$productRepo = new ProductRepository();
// $editProduct = $productRepo->getOnePie($product_id);
// die(var_dump($editProduct));

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

    // die(var_dump($productToUpdate));


    // récuperer l'id du produit
    // die(var_dump($_GET));
 
    // die(var_dump($productId));

    //récupérer la fonction qui permet l'ajout
    //die(var_dump($mustImageBeSavedInDB, $fileName));
    if ($mustImageBeSavedInDB === true) {
        $productRepo->updateWithNewImage($productToUpdate, $productId);
    } else {
        $productRepo->updateWithoutImage($productToUpdate, $productId);
    }
    
}



// rediriger sur la page du membre
// die(var_dump($_SESSION));
$memberId = $_SESSION['user']['id'];

/* autre soluation possible mais qui fait un appel inutile à la bdd
    // rediriger sur la page du membre
    $userRepo = new UserRepository();
    $member = $userRepo->getUserIdByProductId($productId); // récupère un tableau
    $memberId = $member['user_id'];
    // die(var_dump($memberId));
*/

header("Location: member.php?memberId=$memberId"); 
die();