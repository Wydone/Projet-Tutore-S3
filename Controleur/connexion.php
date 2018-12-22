<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    $bd = new bd(); 
    $bd->connect(); 
    $co = $bd->getConnexion() ; 
   
    
    $login =htmlspecialchars(htmlentities(strip_tags( $_POST['login'])));
    $mdp = htmlspecialchars(htmlentities(strip_tags($_POST['mdp']))); 
    
    $login=$co->real_escape_string($login);
    $mdp=$co->real_escape_string($mdp);

    $m = new Membre($login, $mdp); 

    if($m->verifInfos($login, $mdp)){
       
       
        $m->connexion($login, $mdp); 
        $sesCadeaux = $m->getSesCadeaux();
        $sesGroupesAdmin = $m->getSesGroupesAdmin() ; 

        require('..\Vue\mon_profil.php');

       
    }else {
        echo "Utilisateur inconnu" ; // erreur à traiter
    }


?>