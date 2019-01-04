<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();


    $email=htmlspecialchars(htmlentities(strip_tags($_POST['email'])));
    $idGroupe= htmlspecialchars(htmlentities(strip_tags($_POST['ajout-membre-input'])));

    $bd = new bd();
    $bd->connect();
    $co = $bd->getConnexion() ;


    $requete = "SELECT idUser FROM useractif NATURAL JOIN users WHERE emailUser='".$email."'";
    $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
    while($row = mysqli_fetch_assoc($result)){
      $requeteInsert ="INSERT INTO appartient(idGroupe, idUser) VALUES (".$idGroupe.",".$row['idUser'].")";
        $resultInsert = mysqli_query($co, $requeteInsert) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
    }

        header('Location: ..\Vue\mes_groupes.php');


?>
