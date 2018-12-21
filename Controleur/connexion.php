<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 

    $bd = new bd(); 
    $bd->connect(); 
    $co = $bd->getConnexion() ; 
   
    
    $login =htmlspecialchars(htmlentities(strip_tags( $_POST['login'])));
    $mdp = htmlspecialchars(htmlentities(strip_tags($_POST['mdp']))); 
    
    $login=$co->real_escape_string($login);
    $mdp=$co->real_escape_string($mdp);

    if(verifInfos($login, $mdp)){
        connexion($login, $mdp); 
        echo "Success !";
    }else {
        echo "Utilisateur inconnu" ;
    }


?>