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

    public function get6RecentPies() 
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.user_id, p.category_id FROM otartes_product AS p
        WHERE p.active = 1
        ORDER BY `created_at` DESC
        LIMIT 6";

        $query = $this->database->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get3SaltedPies() 
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.user_id, p.category_id FROM otartes_product AS p
        LEFT JOIN `otartes_category` AS cat ON cat.id = p.category_id
        WHERE p.active = 1
        AND cat.id = 1
        ORDER BY RAND()  
        LIMIT 3";

        $query = $this->database->pdo->prepare($sql);
        $query->execute();
        $saltyPies = $query->fetchAll(PDO::FETCH_ASSOC);

        return $saltyPies;
    }

    public function get3SweetPies() 
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.user_id, p.category_id FROM otartes_product AS p
        LEFT JOIN `otartes_category` AS cat ON cat.id = p.category_id
        WHERE p.active = 1
        AND cat.id = 2
        ORDER BY RAND()
        LIMIT 3";

        $query = $this->database->pdo->prepare($sql);
        $query->execute();
        $sweetPies = $query->fetchAll(PDO::FETCH_ASSOC);

        return $sweetPies;
    }

    public function getOnePie(int $id)
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.`ingredients`, p.`recipe`, p.`mixture`, p.`baking`, p.`number`, p.user_id, p.category_id FROM otartes_product AS p WHERE p.id = :ID";
        $query = $this->database->pdo->prepare($sql);

        if(!$query->execute([':ID' => $id])){
            return null;
        }        
        
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function getProductByCategory(int $category_id)
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.user_id, p.category_id FROM otartes_product AS p 
        LEFT JOIN `otartes_category` AS cat ON cat.id = p.category_id
        WHERE p.active = 1
        AND cat.id = :CID
        ORDER BY `created_at` DESC";
        $query = $this->database->pdo->prepare($sql);

        if(!$query->execute([':CID' => $category_id])){
            return null;
        }        
        
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function createProduct(array $product, int $userId) : bool
    {     
        $sql = 'INSERT INTO `otartes_product` (`name`, `image`, `alt`, `ingredients`, `recipe`, `mixture`, `baking`, `number`, `category_id`, `user_id`) 
        VALUES (:nom, :photo, :alt, :ingredient, :recipe, :mixture, :baking, :nbpersonne, :categoryId, :userId)';
        $query = $this->database->pdo->prepare($sql);
        $results = $query->execute([
            ':nom'          => $product['name'],
            ':photo'        => $product['image'],
            ':alt'          => $product['alt'],
            ':ingredient'   => $product['ingredient'],
            ':recipe'       => $product['recipe'],
            ':mixture'      => $product['mixture'],
            ':baking'       => $product['baking'],
            ':nbpersonne'   => $product['nb'],
            ':categoryId'   => $product['categoryId'],
            ':userId'       => $userId,
        ]);

        return $results;
    }

    public function getProductByUserID(int $user_id)
    {
        $sql = "SELECT p.`id`, p.`name`, p.`image`, p.`alt`, p.user_id, p.category_id FROM otartes_product AS p 
        INNER JOIN `otartes_user` AS u ON u.id = p.user_id
        AND u.id = :ID
        ORDER BY p.`created_at` DESC";

        $query = $this->database->pdo->prepare($sql);

        if(!$query->execute([':ID' => $user_id])){
            return null;
        }        
        
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getAllProductMember()
    {
        $sql = "SELECT * FROM `otartes_product` WHERE `user_id`>= 1 ORDER BY `created_at` DESC LIMIT 12";
        $query = $this->database->pdo->prepare($sql);

        $query->execute();
        $allProductMember = $query->fetchAll(PDO::FETCH_ASSOC);

        // die(var_dump($allPies));     
        shuffle($allProductMember);    
        return $allProductMember; 

    }



}
