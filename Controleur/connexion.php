<?php

    require_once('..\Modele\membre.php');
    
    $login = $_POST['login'];
    $mdp = $_POST['mdp']; 
    
    if(verifInfos($login, $mdp)){
        connexion($login, $mdp); 
        echo "Success !";
    }else {
        echo "Utilisateur inconnu" ;
    }


?>