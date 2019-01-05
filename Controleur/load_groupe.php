<?php

    require_once('..\Modele\membre.php');
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    session_start();

    $idGroupe= htmlspecialchars(htmlentities(strip_tags($_GET['idgroupe'])));
    $_SESSION['idLastGroupe']=$idGroupe;

        header('Location: ..\Vue\mes_groupes.php');


?>
