<?php
session_start();
require_once 'models/Autoloader.php';

$title = "Enregistre ta recette ici";

// $uploadService = new UploadService();
// $checkFile = $uploadService->checkUploadedFile();


// Views dont on a besoin
require('templates/header.phtml');
require('templates/pages/upload.phtml');
require('templates/footer.phtml');

// $messageService->deleteMessage();




