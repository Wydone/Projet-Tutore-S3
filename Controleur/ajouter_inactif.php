<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();
    
    $m = new Membre($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['login'], $_SESSION['mdp'], $_SESSION['id']);
    $co = $m->getCo(); 


    $nom = $_POST['nom']; 
    $prenom = $_POST['prenom']; 
    $idCreateur =  $_SESSION['id']; 

    $sesCadeaux = $m->getSesCadeaux();
    $sesGroupesAdmin = $m->getSesGroupesAdmin() ;
    $sesGroupesMembre = $m->getSesGroupesMembre() ;
    $sesInactifs = $m->ajouterInactif($nom, $prenom, $idCreateur) ;
    
    header('Location: ..\Vue\mes_inactifs.php');
       
       
?>