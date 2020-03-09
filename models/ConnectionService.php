<?php

class ConnectionService
{

    public function connectUser(array $user, string $passwordFromForm)
    {
        // s'assurer que le mdp est le bon
        if($user['password'] != $passwordFromForm) {
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

        (new MessageService())->fillMessage("user_connected");

        // die(var_dump($user));

        return $user;
    }

    // déconnecter le user s'il est connecté
    public function disconnectUser()
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            (new MessageService())->fillMessage("user_disconnected");
        }
    }

    // vérifier si le user est connecté
    public function isUserConnected(): bool
    {
        return isset($_SESSION['user']);
    }

}