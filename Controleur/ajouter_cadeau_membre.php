<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();


    $idCadeau=htmlspecialchars(htmlentities(strip_tags($_GET['id'])));
    $idGroupe= htmlspecialchars(htmlentities(strip_tags($_GET['idgroupe'])));
    $_SESSION['idLastGroupe']=$idGroupe;

    $bd = new bd();
    $bd->connect();
    $co = $bd->getConnexion() ;


    $requete = "INSERT INTO contient(idListe, idCadeau) VALUES ('".$idGroupe."','".$idCadeau."')";
    $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
    
        header('Location: ..\Vue\mes_groupes.php');


?>
