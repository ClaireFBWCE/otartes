<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';

$title = "Recette enregistrée";

// vérifier le fichier uploadé
$uploadService = new UploadService();
$uploadService->checkUploadedFile();
$uploadService->checkUploadedFileType();
$destinationPath = $uploadService->getUploadedFile();

// vérifier si champs bien un 'integer'
$checkField = $uploadService->checkIfFieldIsNumeric();

// récap du fichier uploadé
$fileName = $_FILES['file']['name'];
$fileType = $_FILES['file']['type'];
$fileSize = round($_FILES['file']['size']/1024, 2); // passer de octets à ko, et garder une précision de 2 chiffres après la virgule
$filePath = $destinationPath;

// Récupérer les produits
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

    $userId = $_SESSION['user']['id'];

    //récupérer la fonction qui permet l'ajout
    $product->createProduct($productToCreate, $userId);
}

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'uploadProcess.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');