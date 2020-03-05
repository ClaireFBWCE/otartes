<?php

class ProductRepository{

    private $database;

    public function __construct()
    {
        $this->database = new DatabaseConnection();
        $this->database->createConnection();
    }

    public function getAllPies()
    {
        $sql = "SELECT * FROM `otartes_product` WHERE `active` = 1 ORDER BY `created_at` DESC";
        $query = $this->database->pdo->prepare($sql);

        $query->execute();
        $allPies = $query->fetchAll(PDO::FETCH_ASSOC);

        // die(var_dump($allPies));     
        shuffle($allPies);    
        return $allPies; 

    }

    public function get3RecentPies() 
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt` FROM otartes_product AS p
        WHERE p.active = 1
        ORDER BY `created_at` DESC
        LIMIT 3";

        $query = $this->database->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get3SaltedPies() 
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt` FROM otartes_product AS p
        LEFT JOIN `otartes_category` AS cat ON cat.id = p.category_id
        WHERE p.active = 1
        AND cat.id = 1
        LIMIT 3";

        $query = $this->database->pdo->prepare($sql);
        $query->execute();
        $saltyPies = $query->fetchAll(PDO::FETCH_ASSOC);

        shuffle($saltyPies);   
        return $saltyPies;
    }

    public function get3SweetPies() 
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt` FROM otartes_product AS p
        LEFT JOIN `otartes_category` AS cat ON cat.id = p.category_id
        WHERE p.active = 1
        AND cat.id = 2
        ORDER BY `created_at` DESC
        LIMIT 3";

        $query = $this->database->pdo->prepare($sql);
        $query->execute();
        $sweetPies = $query->fetchAll(PDO::FETCH_ASSOC);

        shuffle($sweetPies);   
        return $sweetPies;
    }

    public function getOnePie(int $id)
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.`ingredients`, p.`recipe`, p.`mixture`, p.`baking`, p.`number` FROM otartes_product AS p WHERE p.id = :ID";
        $query = $this->database->pdo->prepare($sql);

        if(!$query->execute([':ID' => $id])){
            return null;
        }        
        
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    /*public function checkImage(string $imageName)
    {
       
        // die(var_dump(__DIR__)); // pour voir quel est le path de l'image -> va dans models

        $fullpath = str_replace('models', 'assets/img/'. $imageName, __DIR__); // pour remplacer le chemins et ne plus aller prendre l'image dans models mais bien dans images
        // die(var_dump($fullpath.'existe ?')); // vérifier si le chemin de l'image existe
        // die(var_dump(file_exists ($fullpath))); // nous donne '1' si ça existe, sinon rien
        // // echo '<br>';
        // die(var_dump(file_exists ($fullpath)));


    //     // vérifier si les images existent
    //     
            // $allProducts = [];
            // foreach ($products as $oneProduct){
    //         if (checkImage($oneProduct['image'])){
    //             $allProducts[] = $oneProduct;
    //         }
    //     }
        
    //     var_dump($allProducts);         

    }*/
}
