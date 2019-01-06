<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();

    if(isset($_SESSION['id'])){
        $m = new Membre($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['login'], $_SESSION['mdp'], $_SESSION['id']);  
        $m->validationEmail() ; 

        header('Location: ..\Vue\mon_profil.php');
    }else {
        echo "Erreur validation impossible" ; 
    }
?>