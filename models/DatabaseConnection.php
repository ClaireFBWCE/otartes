<?php

class DatabaseConnection{
    public $pdo;

    public function createConnection()
    {
        // pour pouvoir switcher entre site local et site online --> défini dans config.php
        if (ENV === "prod") {
            $this->pdo = new PDO('mysql:host=clairebrnusite.mysql.db; dbname=clairebrnusite', "clairebrnusite", "BDDlartdesplantes2020");
        } else {
            $this->pdo = new PDO('mysql:host=127.0.0.1:3308;dbname=otartes_bdd', "root", "");
        }
    }
}

