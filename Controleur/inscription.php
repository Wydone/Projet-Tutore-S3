<?php
    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');

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
    $error = 0 ; 
    $errorNomVide =""; 
    $errorPrenomVide = "";
    $errorLoginVide="";
    $errorEmailVide="";
    $errorMdpVide="";
    $errorMdpVerfiVide="";
    $errorMdpVerif="";
    $errorMdpMatch="";

    if(empty($nom)){
        $errorNomVide = "Le champ nom est vide"; 
        $error = 1; 
    }if(empty($prenom)){
        $errorPrenomVide =  "Le champ prénom est vide" ;
        $error = 1; 
    }if(empty($login)){
        $errorLoginVide =  "Le champ login est vide" ;
        $error = 1; 
    }if(empty($email)){
        $errorEmailVide = "Le champ email est vide" ;
        $error = 1; 
    }if(empty($mdp)){
        $errorMdpVide = "Le champ mdp est vide" ;
        $error = 1; 
    }if(empty($verifMdp)){
        $errorMdpVerfiVide = "Le champ verifier mot de passe est vide" ;
        $error = 1; 
    }if($mdp != $verifMdp){
        $errorMdpVerif = "Mauvaise vérification de mot de passe"; 
        $error = 1 ;
    }
    /*
    if(!preg_match('#/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$mdp)){
        $errorMdpMatch = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un charactère spécial"; 
        $error = 1; 
    }
     */
    $m = new Membre($nom, $prenom, $email, $login, $mdp); 
    echo $error ; 
    if($error == 0) {
        if($m->inscription($nom, $prenom, $email, $login, $mdp)){
            $m->connexion($login, $mdp); 
            $sesCadeaux = $m->getSesCadeaux();
            $sesGroupesAdmin = $m->getSesGroupesAdmin() ; 
        
             header('Location: ..\Vue\mon_profil.php'); 
        }else {
            $errorExist = "L'utilisateur existe déjà";
            header('Location: ..\Vue\formulaire_inscription.php?errorExist='.$errorExist.''); 
        }
    }else {
        header('Location: ..\Vue\formulaire_inscription.php?errorNomVide='.$errorNomVide.'&errorPrenomVide='.$errorPrenomVide.'&errorLoginVide='.$errorLoginVide.'&errorEmailVide='.$errorEmailVide.'&errorMdpVide='.$errorMdpVide.'&errorMdpVerfiVide='.$errorMdpVerfiVide.'&errorEmailMatch='.$errorMdpMatch.'&errorMdpVerif='.$errorMdpVerif.''); 
    }
  
    
   
?>