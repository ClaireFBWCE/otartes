<?php

// require_once 'models/Autoloader.php';

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

        /*if (empty($user) === true) {
            return false;
        } else {
            return true;
        }*/

        return !empty($user);
    }

    public function createUser(string $firstname, string $lastname, string $email, string $password)
    {
        // $stmt = $this->dbConnect->query("INSERT INTO otartes_user (firstname, lastname, email, 'password') VALUES ($firstname, $lastname, $email, $password)");
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = $this->dbConnect->pdo;

        // insérer dans SQL
        $sql = "INSERT INTO otartes_user (`lastname`, `firstname`, `email`, `password`) VALUES (:lastname, :firstname, :email, :pass)";

       // $sth = $pdo->query($sql);

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

    public function connectUser(string $email, string $password)
    {
        
        // récupérer le SQL
        $userSQL = "SELECT * FROM otartes_user WHERE email = :EMAIL";
        // die(var_dump($userSQL));
        $query = $this->dbConnect->pdo->prepare($userSQL);

        if(!$query->execute([':EMAIL' => $email])){
            return false;
        }
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // die(var_dump($user));

        // s'assurer que le user existe
        if(empty($user))
        return false;

        

        // s'assurer que le mdp est le bon
        if($user['password'] != $password) {
            return false;
        }
                        
        /*
        // comparer les 2 mdp
        if(!password_verify($password, $user['password'])){
            return false;
        } */

        
        // gérer les sessions
        unset($user['password']); // on détruit le mdp pour pas qu'il soit visible
        $_SESSION['user'] = $user;
        // die(var_dump($user));

        return $user;

    }

    // public function disconnectUser()
    // {
    //     if(isset($_SESSION['user'])){
    //         unset($_SESSION['user']);
    //     }
    // }

    // public function userIsConnected()
    // {
    //     return isset($_SESSION['user']);

    // }

}