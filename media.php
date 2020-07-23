<?php
session_start();

require_once 'models/Autoloader.php';

$title = 'Media baby !';  

// Views dont on a besoin
require('templates\header.phtml');
require('templates\pages\media.phtml');
require('templates\footer.phtml');