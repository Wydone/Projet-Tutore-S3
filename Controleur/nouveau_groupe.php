<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();


    $titre=htmlspecialchars(htmlentities(strip_tags($_POST['titre'])));
    $idAdmin= $_SESSION['id'];

    $bd = new bd();
    $bd->connect();
    $co = $bd->getConnexion() ;


    $requeteInsert = "INSERT INTO groupe(nomGroupe, idUser) VALUES ('".$titre."','".$idAdmin."')";
    $result = mysqli_query($co, $requeteInsert) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
    $last_id = $co->insert_id;
    echo $last_id;
    $_SESSION['idLastGroupe']=$last_id;

    $requeteInsertAppartient = "INSERT INTO appartient(idGroupe, idUser) VALUES ('".$last_id."','".$idAdmin."')";
    $result2 = mysqli_query($co, $requeteInsertAppartient) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
        $membre=new Membre($idAdmin);
        $membre->getSesGroupesMembre();

        header('Location: ..\Vue\mes_groupes.php');


?>
