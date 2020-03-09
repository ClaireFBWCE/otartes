<?php

require_once 'models/Autoloader.php';

$title = "Tu t'inscris baby !";
$messageService = new MessageService();

// Views dont on a besoin
require('templates/header.phtml');
require('templates/pages/signUp.phtml');
require('templates/footer.phtml');

$messageService->deleteMessage();
