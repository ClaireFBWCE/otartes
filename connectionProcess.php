<?php
session_start();

require_once 'models/Autoloader.php';

$title = "On process la connexion baby !";

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
}


// On instancie les classes de base de donnée pour récupérer le user qui correspond à l'email rentré
$userConnection = new UserRepository();

/* 2 façons de faire : 
1.
$email = $_POST['email'];
$password = $_POST['password'];
$connectionResult = $userConnection->connectUser($email, $password);

2. */

$connectionResult = $userConnection->connectUser($_POST['email'], $_POST['password']);
// die(var_dump($connectionResult));

if(!$connectionResult) {
    header("Location: connection.php");
    die();
}


// // echo 'je suis bien connectée en tant que ' .$_POST['email'];


header("Location: index.php");

// On vérifie ici que les passwords sont concordants

// Si oui --> on revoie vers l'url index.php et on stocke l'info en session

// Si non --> on renvoir vers l'url inscripton.php


    