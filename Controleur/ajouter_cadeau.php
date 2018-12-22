<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php'); 
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();

    //Gérer l'ajout d'image plus tard dans la base de données

    $m = new Membre($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['login'], $_SESSION['mdp'], $_SESSION['id']);

        if(isset($_POST['nom'])) {
            $nom =htmlspecialchars(htmlentities(strip_tags( $_POST['nom'])));
        }
        if(empty($_POST['desc'])){
            $desc = "NULL"; 
        }else {
            $desc =htmlspecialchars(htmlentities(strip_tags( $_POST['desc'])));
        }
        /*if(!isset( $_FILES['image'])){
            $img = "NULL"; 
        }else{
            $img = $_FILES['image'];
        }*/
        if(empty($_POST['lien'])){
            $lien = "NULL"; 
        }else {
            $lien =htmlspecialchars(htmlentities(strip_tags( $_POST['lien'])));
        }
        
        
        $img= "NULL"; //pour pouvoir traiter l'ajout de cadeau sans images pour le moment
        $sesCadeaux = $m->ajouterCadeau($nom, $desc, $img, $lien);
        $sesGroupesAdmin = $m->getSesGroupesAdmin() ; 
       
        require('..\Vue\mon_profil.php');
?>