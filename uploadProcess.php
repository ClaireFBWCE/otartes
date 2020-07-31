<?php
session_start();

require_once 'models/Autoloader.php';

$title = "Recette enregistrée";

/* vérifier le fichier uploadé */
// die(var_dump($_FILES));
$uploadService = new UploadService();
// var_dump($_FILES);
$uploadService->checkUploadedFile();
$uploadService->checkUploadedFileType();
$destinationPath = $uploadService->getUploadedFile();

/* vérifier si champs bien un 'integer' */
$checkField = $uploadService->checkIfFieldIsNumeric();
// die(var_dump($checkField));




// récap du fichier uploadé
$fileName = $_FILES['file']['name'];
$fileType = $_FILES['file']['type'];
$fileSize = round($_FILES['file']['size']/1024, 2); // passer de octets à ko, et garder une précision de 2 chiffres après la virgule
// var_dump($fileSizeRound);
// $filePath = $destinationPath;

// die(var_dump($_REQUEST));
// die(var_dump($_FILES));

$product = new ProductRepository;

if(!empty($_POST)){

    // verfier que les champs du form ne sont pas vides
    $uploadService->checkFieldNotEmpty();
    
    // récupérer et créer les données
    $productToCreate = [
        'name' => $_POST['nameRecipe'],
        'image' => $fileName, // ici on a déjà vérifieé plus haut si ça existe
        'alt' => $_POST['nameRecipe'],
        'ingredient' => $_POST['ingredients'],
        'recipe' => $_POST['recipe'],
        'baking' => intval($_POST['baking']),
        'mixture' => intval($_POST['mixture']),
        'nb' => intval($_POST['personne']),
        'categoryId' => intval($_POST['categoryId']),

    ];

    // die(var_dump($productToCreate));

    $userId = $_SESSION['user']['id'];

    //récupérer la fonction qui permet l'ajout
    $product->createProduct($productToCreate, $userId);
}


// Views dont on a besoin
require('templates/header.phtml');
require('templates/pages/uploadProcess.phtml');
require('templates/footer.phtml');
