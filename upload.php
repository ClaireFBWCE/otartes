<?php
session_start();
require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';

$title = "Enregistre ta recette ici";

// Views dont on a besoin
require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'upload.phtml');
require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');