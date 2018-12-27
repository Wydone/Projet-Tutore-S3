<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();

    $m = new Membre($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['login'], $_SESSION['mdp'], $_SESSION['id']);
    $co = $m->getCo(); 
    
    $id = $_SESSION['idCadeauSupprime']; 
    echo $id ; 
   // $sesCadeaux = $m->supprimerCadeau($_SESSION['idCadeauSupprime']); 
    $sesGroupesAdmin = $m->getSesGroupesAdmin() ; 
    
   // require('..\Vue\mon_profil.php');
?>