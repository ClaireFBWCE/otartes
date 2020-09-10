<?php
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';

$title = "On process la connexion";

// On récupère les données du formulaire d'inscription en POST
function isDataFromConnectionValid(): bool{
    
    // verifier que le formulaire est valide
    $email    = isset($_POST['email'])    ? $_POST['email']    : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    
    // vérifier les champs obligatoires
    if (!$email || !$password){
        return false;
    }
    
    return true;
}

if(isDataFromConnectionValid() === false){
    header("Location: connection.php");
    die();
}

// On instancie les classes de base de donnée pour récupérer le user qui correspond à l'email rentré
$userRepo = new UserRepository();
// on récupère le user
$user = $userRepo->getOneUserByEmail($_POST['email']);
if (!$user) {
    throw new Exception('No User found for email ' . $_POST['email']);
}

// On instancie la classe ConnectionService
$connectionService = new ConnectionService();
// on connecte le user
$connectionResult = $connectionService->connectUser($user, $_POST['password']);


if(!$connectionResult) {
    header("Location: connection.php");
    die();
}


// echo 'je suis bien connectée en tant que ' .$_POST['email'];
$userId = $user['id'];
header("Location: member.php?memberId=$userId");
die('');

// On vérifie ici que les passwords sont concordants

// Si oui --> on revoie vers l'url index.php et on stocke l'info en session

// Si non --> on renvoir vers l'url inscripton.php


    