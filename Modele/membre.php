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

    function inscription($nom, $prenom, $email, $login, $mdp){
        $bd = new bd(); 
        $bd->connect(); 
        $co = $bd->getConnexion();
        
        $requete1 = "INSERT INTO USERS (nomUser, prenomUser)VALUES ('$nom', '$prenom' )" ; 
        $result = mysqli_query($this->connect, $requete1)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->connect));
        $requete2 = "INSERT INTO USERACTIF SELECT idUser, '$email', '$login', '$mdp', false FROM USERS WHERE idUser = LAST_INSERT_ID()"  ; 
        $result = mysqli_query($this->connect, $requete2)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->connect));
    }


?>