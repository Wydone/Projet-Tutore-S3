<?php
    require_once('..\Modele\bdd.php'); 

   
    function connexion($login, $mdp){
        $bd = new bd(); 
        $bd->connect(); 
        $co = $bd->getConnexion() ; 
        
        $requete = "SELECT nomUser, prenomUser, emailUser FROM useractif NATURAL JOIN users WHERE loginUser='$login' AND passwordUser= '$mdp'"; 
        $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
        $data = mysqli_fetch_assoc($result); 

        session_start();
        $_SESSION['login']= $login ; 
        $_SESSION['mdp']= $mdp;
        $_SESSION['nom']= $data['nomUser'];
        $_SESSION['prenom']= $data['prenomUser'];
        $_SESSION['email']= $data['emailUser'];

        $bd->deconnect(); 
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
        $bd->deconnect(); 
    }

    function inscription($nom, $prenom, $email, $login, $mdp){
        $bd = new bd(); 
        $bd->connect(); 
        $co = $bd->getConnexion();
        
        $nom = $co->real_escape_string($nom); 
        $prenom = $co->real_escape_string($prenom); 
        $email = $co->real_escape_string($email); 
        $login = $co->real_escape_string($login); 
        $mdp = $co->real_escape_string($mdp); 

        $requete1 = "INSERT INTO USERS (nomUser, prenomUser)VALUES ('$nom', '$prenom' )" ; 
        $result = mysqli_query($co, $requete1)  or die ("Exécution de la requête insert impossible ".mysqli_error($co));
        $requete2 = "INSERT INTO USERACTIF SELECT idUser, '$email', '$login', '$mdp', false FROM USERS WHERE idUser = LAST_INSERT_ID()"  ; 
        $result = mysqli_query($co, $requete2)  or die ("Exécution de la requête insert impossible ".mysqli_error($co));
        
        $bd->deconnect();
    }


?>