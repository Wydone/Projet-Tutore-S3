<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();
    if(isset($_POST ["submit"])){
    $mdp =htmlspecialchars(htmlentities(strip_tags( $_POST['mdp'])));
    $verifMdp = htmlspecialchars(htmlentities(strip_tags($_POST['verfimdp']))); 
   
        
        $m = new Membre($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['login'], $_SESSION['mdp'], $_SESSION['id']);
        $co = $m->getCo(); 
        
        
        if($mdp != $verifMdp){
            echo "erreur la confrirmation du mot de passe est fausse"; //erreur à traiter
        }else{
            $mdp=$co->real_escape_string($mdp);
            $mdpModifie = $m->modifierMdp($mdp); 

            $sesCadeaux = $m->getSesCadeaux();
            $sesGroupesAdmin = $m->getSesGroupesAdmin() ; 
            
          //  require('..\Vue\mon_profil.php');
            header('Location: ..\Vue\mon_profil.php'); 
        }
    }

    
   

    

?>
