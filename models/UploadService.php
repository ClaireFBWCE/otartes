<?php

class UploadService {

    public const VALID_TYPES = ['image/jpeg', 'image/png'];
    public const MAX_SIZE = 200000; //en octet

    public function checkUploadedFile()
    {        
        // verifier qu'on a bien un nom de fichier
        if(empty($_FILES['file']['name'])){ 
            header("Location: upload.php");
            die();
        }
    }

    /**
     * return filename if there is one or null
     */
    public function checkAndUploadFileForRecipeUpdate(int $productId):bool
    {        
        // verifier qu'on a bien un nom de fichier
        $name = $_FILES['file']['name'];
        if(!empty($name)){ 
            $this->checkUploadedFileTypeForUpdate($productId);
            $this->getUploadedFile();
            $mustImageBeSavedInDB = true;
        } else {
            $mustImageBeSavedInDB = false;
        }

        return $mustImageBeSavedInDB;
    }

    public function checkUploadedFileType()
    {     
      
        $type = $_FILES['file']['type']; // on récupère le type
        if(!in_array($type, self::VALID_TYPES)){ // savoir si le 'type' est dans le tableau. Si ce n'est pas dans la tableau, on s'en va
            header("Location: upload.php");
            die();
        }
        
        // verifier la taille
        $size = $_FILES['file']['size'];
        if($size > self::MAX_SIZE){
            header("Location: upload.php");
            die();
        }
    }

    public function checkUploadedFileTypeForUpdate(int $productId)
    {     
      
        $type = $_FILES['file']['type']; // on récupère le type
        if(!in_array($type, self::VALID_TYPES)){ // savoir si le 'type' est dans le tableau. Si ce n'est pas dans la tableau, on s'en va
            header("Location: edit.php?productId=$productId");
            die();
        }
        
        // verifier la taille
        $size = $_FILES['file']['size'];
        if($size > self::MAX_SIZE){
            header("Location: edit.php?productId=$productId");
            die();
        }
    }

    public function checkFieldNotEmpty()
    {
        if(
            empty($_POST['nameRecipe']) ||
            empty($_POST['ingredients']) ||
            empty($_POST['recipe']) ||
            empty($_POST['baking']) ||
            empty($_POST['mixture']) ||
            empty($_POST['personne']) ||
            empty($_POST['categoryId'])
        ) {
            header("Location: upload.php");
            die();
        }

    }

    public function getUploadedFile()
    {
        // //récupérer le dossier actuel - pour connaitre le chemin du dossier
        // // pour le moment il est stocké ici : C:\wamp64\tmp\phpB587.tmp mais on veut le stocker dans le dossier upload
        // $currentDir = dirname(__FILE__); // FILE 
        // echo $currentDir. '<br>';
        // $destinationDir = $currentDir.'/uploads/'; // on dit qu'on le met dans upload
        // echo $destinationDir. '<br>';
        // $destination = $destinationDir.$_FILES['file']['name']; // on veut récupérer le nom du fichier
        // echo $destination . '<br>';
        // // if(!move_uploaded_file($_FILES['file']['tmp_name'], $destination)){ // on bouge le fichier dans upload
        // //     echo 'fichier non téléchargé';
        // //     header("Location: upload.php");
        // //     die();
        // // }


        // //récupérer le dossier actuel - pour connaitre le chemin du dossier
        // // pour le moment il est stocké ici : C:\wamp64\tmp\phpB587.tmp mais on veut le stocker dans le dossier upload
        $currentPath = $_FILES['file']['tmp_name'];
        // echo $currentPath. '<br>';

        $destinationPath = 'uploads/'.$_FILES['file']['name'];
        // echo $destinationPath. '<br>';

        $moveTheFile = move_uploaded_file($currentPath, $destinationPath);
        // echo $moveTheFile. '<br>';

        if(!$moveTheFile){
            header("Location: upload.php");
            die();
        }

        return $destinationPath;

    }

    function checkIfFieldIsNumeric() 
    {
        if(!is_numeric($_POST['baking']) || !is_numeric($_POST['mixture']))
        {
            header("Location: upload.php");
            die();
        }
    }
        

}