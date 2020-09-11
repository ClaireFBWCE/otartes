<?php
// On revoie vers l'url index.php et on connecte l'utilisateur en session
session_start();

require_once 'config'.DIRECTORY_SEPARATOR.'config.php';
require_once 'models/Autoloader.php';

$connectionService = new ConnectionService();
$userDisconnected = $connectionService->disconnectUser();

header("Location: index.php");