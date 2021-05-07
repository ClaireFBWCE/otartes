<?php
    session_start();
    require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
    require_once 'models/Autoloader.php';

    $title = "Page de connexion / inscription";
    $messageService = new MessageService();

    // Views dont on a besoin
    require('templates' . DIRECTORY_SEPARATOR . 'header.phtml');
    require('templates' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'connection.phtml');
    require('templates' . DIRECTORY_SEPARATOR . 'footer.phtml');

    $messageService->deleteMessage();