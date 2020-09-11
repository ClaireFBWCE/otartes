<?php
// On revoie vers l'url index.php et on connecte l'utilisateur en session
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';

$title = "On process l'inscription baby !";

// On récupère les données du formulaire d'inscription en POST
function isDataFromFormValid(): bool
{

    //vérifier que le formulaire est valide les champs bien remplis
    $lastname  = isset($_POST['lastname'])  ? $_POST['lastname']  : false;
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : false;
    $email     = isset($_POST['email'])     ? $_POST['email']     : false;
    $password  = isset($_POST['password'])  ? $_POST['password']  : false;
    
    //vérifier les champs obligatoires
    if (!$lastname || !$firstname || !$email || !$password) {
        return false;
    }
    
    // vérifier le format de l'email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
    }

    // vérifier la taille du mdp
    if(strlen ($password)<6){
        return false;
    }
    
    return true;
}

//vérifier la validité des datas
if (isDataFromFormValid() === false) {
    header("Location: signUp.php");
    die();
}

// On checke si l'email existe déjà en base de donnée
$userRepository = new UserRepository();

if ($userRepository->doesEmailExists($_POST['email'])) {

    (new MessageService())->fillMessage("email_not_exists");

    header("Location: signUp.php");
    die();
}

// On est bon, on enregistre le nouveau user
$userId = $userRepository->createUser($_POST['firstname'],  $_POST['lastname'], $_POST['email'], $_POST['password']);

(new MessageService())->fillMessage("user_created");

header("Location: index.php");