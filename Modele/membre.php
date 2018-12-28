<?php
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');

    
class Membre{

//ATTRIBUTS DE LA CLASSE
    private $co ;
    private $id ;
    private $nom ;
    private $prenom ;
    private $login;
    private $mdp;
    private $email;

    private $sesCadeaux; //la liste de ses cadeaux souhaité
    private $sesGroupesAdmin; //la liste des groupes qu'il administre
    private $sesGroupesMembre; //la liste des groupes dont il est membre


//------------------------
//CONSTRUCTEUR DE MEMBRES
//------------------------
    function __construct(){
        $bd = new bd();
        $bd->connect();
        $this->co = $bd->getConnexion() ;

        $this->sesCadeaux = array();
        $this->sesGroupesAdmin = array();

        $nbArg = func_num_args();
        if($nbArg == 2){ //connexion
            $this->login = func_get_arg(0) ;
            $this->mdp = func_get_arg(1) ;

        }else if($nbArg == 5){

            $this->nom = func_get_arg(0);
            $this->prenom = func_get_arg(1);
            $this->email = func_get_arg(2);
            $this->login = func_get_arg(3);
            $this->mdp = func_get_arg(4);
        }else if($nbArg ==6) {
            $this->nom = func_get_arg(0);
            $this->prenom = func_get_arg(1);
            $this->email = func_get_arg(2);
            $this->login = func_get_arg(3);
            $this->mdp = func_get_arg(4);
            $this->id = func_get_arg(5);
        }
    }

//----------------
//  GETTERS 
//----------------

    function getCo() {
        return $this->co ;
    }
    function getNom() {
        return $this->nom ;
    }

//FONCTION DE CONNEXION (SI L'UTILISATEUR EXISTE DEJA) 
    function connexion($login, $mdp){

        $requete = "SELECT idUser, nomUser, prenomUser, emailUser FROM useractif NATURAL JOIN users WHERE loginUser='$login' AND passwordUser= '$mdp'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));
        $data = mysqli_fetch_assoc($result);

        $this->id = $data['idUser'];
        $this->nom = $data['nomUser'];
        $this->prenom = $data['prenomUser'];
        $this->email = $data['emailUser'];

        session_start();

        $_SESSION['id']= $data['idUser'] ;
        $_SESSION['login']= $login ;
        $_SESSION['mdp']= $mdp;
        $_SESSION['nom']= $data['nomUser'];
        $_SESSION['prenom']= $data['prenomUser'];
        $_SESSION['email']= $data['emailUser'];
    }

//FONCTION DE DECONNEXION
    function deconnexion() {
        session_destroy() ;
        mysqli_close($this->connect);
    }

//FONCTION DE VERIFICATION POUR VOIR SI L'UTILISATEUR EXITE DANS LA BASE DE DONNEES    
    function verifInfos($login, $mdp){

        $requete = "SELECT idUser FROM useractif WHERE loginUser='$login' AND passwordUser= '$mdp'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));

        if(mysqli_num_rows($result) == 1){
            return true ;
        }else {
            return false ;
        }
    }

//AJOUTER UN NOUVEAU MEMBRE DANS LA BASE DE DONNEES     
    function inscription($nom, $prenom, $email, $login, $mdp){

        $this->nom = $this->co->real_escape_string($nom);
        $this->prenom = $this->co->real_escape_string($prenom);
        $this->email = $this->co->real_escape_string($email);
        $this->login = $this->co->real_escape_string($login);
        $this->mdp = $this->co->real_escape_string($mdp);

        if(!$this->verifInfos($login, $mdp)){

            $requete1 = "INSERT INTO USERS (nomUser, prenomUser)VALUES ('$nom', '$prenom' )" ;
            $result = mysqli_query($this->co, $requete1)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
            $requete2 = "INSERT INTO USERACTIF SELECT idUser, '$email', '$login', '$mdp', false FROM USERS WHERE idUser = LAST_INSERT_ID()";
            $result = mysqli_query($this->co, $requete2)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));

            return true ;

        }else{

            echo "Utilisateur existe deja ! " ;//gérer cette erreur
            return false ;
        }
    }

//FONCTION DE MODIFICATION DE MDP POUR UN UTILISATEUR QUI EXISTE DEJA
    function modifierMdp($mdp){
        $this->mdp = $mdp ;
        $requete = "UPDATE useractif SET passwordUser = '$this->mdp' WHERE idUser = '$this->id'" ;
        $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));

        return true ;
    }

//FONCTION POUR OBTENIR LA LISTE DES CADEAUX D'UN MEMBRE
    function getSesCadeaux(){
        $requete = "SELECT * FROM cadeau NATURAL JOIN users NATURAL JOIN useractif WHERE idUser='$this->id'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));

        while($row = mysqli_fetch_assoc($result)){
            $cadeau = new Cadeau($this->id, $row['nomCadeau'], $row['descriptionCadeau'],$row['imageCadeau'],$row['lienCadeau'], $row['idCadeau']);
            array_push($this->sesCadeaux, $cadeau);
        }

        return $this->sesCadeaux;
    }

//FONCTION POUR OBTENIR LA LISTE DE GROUPE QUE LE MEBRE ADMINISTRE 
    function getSesGroupesAdmin(){
        $requete = "SELECT idGroupe, nomGroupe FROM groupe NATURAL JOIN users NATURAL JOIN useractif WHERE idUser='$this->id'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));

        while($row = mysqli_fetch_assoc($result)){
            $groupe = new Groupe($row['idGroupe'], $row['nomGroupe'], $this->id);
            array_push($this->sesGroupesAdmin, $groupe);
        }
        return $this->sesGroupesAdmin;
    }

//FONCTION POUR OBTENIR LA LISTE DES GROUPE DONT LE MEMBRE FAIT PARTIE
    function getSesGroupesMembre(){
        $requete = "SELECT idGroupe, nomGroupe FROM groupe NATURAL JOIN appartient NATURAL JOIN users NATURAL JOIN useractif WHERE idUser='$this->id'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));

        while($row = mysqli_fetch_assoc($result)){
            $groupe = new Groupe($row['idGroupe'], $row['nomGroupe'], $this->id);
            array_push($this->sesGroupesMembre, $groupe);
        }
        return $this->sesGroupesMembre;
    }

//FONCTION D'AJOUT D'UN NOUVEAU CADEAU A SA LISTE DE CADEAUX SOUHAITE
    function ajouterCadeau($nom, $desc, $img, $lien, $idUser) {
       
        $desc = NULL; 
        $img = NULL ; 
        $lien = NULL; 
    
        $requete = "INSERT INTO Cadeau (nomCadeau, descriptionCadeau, imageCadeau, lienCadeau, acheteCadeau, idUser, idUser_acheteur) VALUES ('$nom', '$desc', '$img', '$lien' , false , '$this->id', null)" ; 
        $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        
         return $this->getSesCadeaux(); 
    }

//FONCTION DE SUPPRESSION D'UN CADEAU DE SA LISTE DE CADEAUX SOUHAITE
    function supprimerCadeau($id){
        $requete = "DELETE FROM cadeau Where idCadeau = $id" ; 
        $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        
        return $this->getSesCadeaux(); 
    }

}


?>
