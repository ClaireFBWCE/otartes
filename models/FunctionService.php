<?php

//securiser l'intrusion html
function secureUserId(int $userId)
{
    if ($userId !== intval($_SESSION['user']['id'])){
    header("Location: index.php");
    die();
    }
}

function checkInGETOrRedirect(string $value,  string $type)
{
    if (isset($_GET[$value])) {
        switch ($type) {
            case 'int':
                $verifType = is_numeric($_GET[$value]);
                break;
            case 'bool':
                if ($_GET[$value] === 'true' || $_GET[$value] === 'false') {
                    $verifType = true;
                }
            case 'string':
                $verifType = true;
                break;
            default:
                $verifType = false;
                break; 
        }

        if ($verifType) {
            return $_GET[$value];
        }else {
            goToIndex();
        }
    } else {
        goToIndex();
    }
}

function goToIndex()
{
    header("Location: index.php"); 
    die();
}
