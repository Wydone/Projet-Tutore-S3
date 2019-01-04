<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();


    $idGroupe= htmlspecialchars(htmlentities(strip_tags($_POST['supprimer-groupe-input'])));

    $bd = new bd();
    $bd->connect();
    $co = $bd->getConnexion() ;


    $requete = "DELETE FROM groupe WHERE groupe.idGroupe = '".$idGroupe."'";
    $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));

    $idAdmin= $_SESSION['id'];
    $membre=new Membre($idAdmin);
    $membre->getSesGroupesMembre();

        header('Location: ..\Vue\mes_groupes.php');


?>
