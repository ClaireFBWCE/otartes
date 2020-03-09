<?php
session_start();
require_once 'models/Autoloader.php';

$title = "Tu te connecte baby !";
$messageService = new MessageService();

// Views dont on a besoin
require('templates/header.phtml');
require('templates/pages/connection.phtml');
require('templates/footer.phtml');

$messageService->deleteMessage();




