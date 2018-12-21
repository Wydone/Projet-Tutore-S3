<?php
    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');

    $bd = new bd(); 
    $bd->connect(); 
    $co = $bd->getConnexion() ; 
    
    $email = htmlspecialchars(htmlentities(strip_tags( $_POST['email']))); 
    $nom = htmlspecialchars(htmlentities(strip_tags($_POST['nom']))); 
    $prenom = htmlspecialchars(htmlentities(strip_tags( $_POST['prenom'])));
    $login = htmlspecialchars(htmlentities(strip_tags($_POST['login'])));
    $mdp = htmlspecialchars(htmlentities(strip_tags($_POST['mdp'])));
    $verifMdp = htmlspecialchars(htmlentities(strip_tags( $_POST['verifMdp'])));
    
    //vérifier les informations à mettre en forme plus tard avec bootstrap
   
    if(empty($nom)){
        echo "Le champ nom est vide"; 
    }else if(empty($prenom)){
        echo "Le champ prénom est vide" ;
    }else if(empty($login)){
        echo "Le champ login est vide" ;
    }else if(empty($email)){
        echo "Le champ email est vide" ;
    }else if(empty($mdp)){
        echo "Le champ mdp est vide" ;
    }else if(empty($verifMdp)){
        echo "Le champ verifMdp est vide" ;
    }/*else {
        if(!preg_match('#/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$mdp)){
            ehco "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un charactère spécial"; 
        }
    }*/
    if(inscription($nom, $prenom, $email, $login, $mdp)) {
        connexion($login, $mdp); 
        header('Location: ..\Vue\monprofil.php');
    } 
  
    
   
?>