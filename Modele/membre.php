<?php
    require_once('..\Modele\bdd.php'); 

   
    function connexion($login, $mdp){
        session_start();
        $_SESSION['login']= $login ; 
        $_SESSION['mdp']= $mdp;
    }

    function deconnexion() {
        session_destroy() ; 
        deconnect(); 
    } 

    function verifInfos($login, $mdp){
        $bd = new bd(); 
        $bd->connect(); 
        $co = $bd->getConnexion() ; 
       
        $requete = "SELECT idUser FROM useractif WHERE loginUser='$login' AND passwordUser= '$mdp'"; 
        $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
        
        if(mysqli_num_rows($result) == 1){
            return true ; 
        }else {
            return false ; 
        }
    }



?>