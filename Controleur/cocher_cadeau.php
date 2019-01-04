<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');



    session_start();

    $bd = new bd();
    $bd->connect();
    $co = $bd->getConnexion() ;

    $idcadeau=$_GET['id'];
    $newetat=$_GET['newetat'];
    $_SESSION['idLastGroupe']=$_GET['idgroupe'];

    $requete="UPDATE cadeau SET acheteCadeau='".$newetat."',idUser_acheteur='".$_SESSION['id']."' WHERE  idCadeau='".$idcadeau."'";
    $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));

    header('Location: ..\Vue\mes_groupes.php');

?>
