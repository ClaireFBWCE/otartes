<?php

class UserRepository{

    public $dbConnect;

    public function __construct()
    {
        // connection à la BDD
        $this->dbConnect = new DatabaseConnection();
        $this->dbConnect->createConnection();
    }

    public function doesEmailExists(string $email): bool {

        $sql = "SELECT * FROM otartes_user WHERE email = :EMAIL";
        $query = $this->dbConnect->pdo->prepare($sql);

        if(!$query->execute([':EMAIL' => $email])){
            throw new Exception("Error with the sql prepare");
        }
        $user = $query->fetch(PDO::FETCH_ASSOC);

        return !empty($user);
    }

    public function createUser(string $firstname, string $lastname, string $email, string $password)
    {
        $pdo = $this->dbConnect->pdo;

        // insérer dans SQL
        $sql = "INSERT INTO otartes_user (`lastname`, `firstname`, `email`, `password`) VALUES (:lastname, :firstname, :email, :pass)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $password);

        $res = $stmt->execute();

        if (!$res) {
            throw new Exception("An Sql error has occured !");
        }

        return $pdo->lastInsertId();
    }

    public function getOneUserByEmail(string $email)
    {
         // récupérer le SQL
         $userSQL = "SELECT * FROM otartes_user WHERE email = :EMAIL";
         $query = $this->dbConnect->pdo->prepare($userSQL);
 
         if(!$query->execute([':EMAIL' => $email])){
             return false;
         }
         $user = $query->fetch(PDO::FETCH_ASSOC);

         // s'assurer que le user existe
        if(empty($user)) {
            return false;
        }
            
        return $user;
    }

    public function getAllUsers()
    {
        $userSQL = 'SELECT * FROM otartes_user';
        $query = $this->dbConnect->pdo->prepare($userSQL);
        
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneUserById($memberId)
    {
         // récupérer le SQL
         $userSQL = "SELECT * FROM otartes_user WHERE id = :ID";
         $query = $this->dbConnect->pdo->prepare($userSQL);
 
         if(!$query->execute([':ID' => $memberId])){
             return false;
         }
         $user = $query->fetch(PDO::FETCH_ASSOC);

         // s'assurer que le user existe
        if(empty($user)) {
            return false;
        }
            
        return $user;
    } 
}