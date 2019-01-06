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
    private $idCreateur; // utile seulement si le membre est un membre inactif 
    private $sesCadeaux; //la liste de ses cadeaux souhaité
    private $sesGroupesAdmin; //la liste des groupes qu'il administre
    private $sesGroupesMembre; //la liste des groupes dont il est membre
    private $sesInactifs ; //liste des membres inactifs que l'utilisateur à créé

//------------------------
//CONSTRUCTEUR DE MEMBRES
//------------------------
    function __construct(){
        $bd = new bd();
        $bd->connect();
        $this->co = $bd->getConnexion() ;
        $this->sesCadeaux = array();
        $this->sesGroupesAdmin = array();
        $this->sesGroupesMembre = array();
        $this->sesInactifs = array() ; 
        $nbArg = func_num_args();
        if($nbArg == 1){
          $this->id = func_get_arg(0);
          $this->trouverNomPrenom();
        }else if($nbArg == 2){ //connexion
            $this->login = func_get_arg(0) ;
            $this->mdp = func_get_arg(1) ;
        }else if($nbArg == 5){
            $this->nom = func_get_arg(0);
            $this->prenom = func_get_arg(1);
            $this->email = func_get_arg(2);
            $this->login = func_get_arg(3);
            $this->mdp = func_get_arg(4);
        }else if($nbArg == 6) {
            $this->nom = func_get_arg(0);
            $this->prenom = func_get_arg(1);
            $this->email = func_get_arg(2);
            $this->login = func_get_arg(3);
            $this->mdp = func_get_arg(4);
            $this->id = func_get_arg(5);
        }else if($nbArg == 4) {
            $this->nom = func_get_arg(0);
            $this->prenom = func_get_arg(1);
            $this->id = func_get_arg(2); 
            $this->idCreateur = func_get_arg(3); 
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

    function getPrenom(){
        return $this->prenom ; 
    }
    function getID() {
        return $this->id; 

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
        //ajout SESSION sesGroupesAdmin, sesCadeaux
        $_SESSION['sesCadeaux']= $this->sesCadeaux;
        $_SESSION['sesGroupesAdmin']= $this->sesGroupesAdmin;
        $_SESSION['sesGroupesMembre']= $this->sesGroupesMembre;

        $_SESSION['sesInactifs']= $this->sesInactifs;

        $_SESSION['idLastGroupe']=1;

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
        $requete = "SELECT * FROM cadeau NATURAL JOIN users NATURAL JOIN useractif NATURAL JOIN userinactif WHERE idUser='$this->id'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche cadeau impossible ".mysqli_error($this->co));
        
        while($row = mysqli_fetch_assoc($result)){
            $cadeau = new Cadeau($this->id, $row['nomCadeau'], $row['descriptionCadeau'],$row['imageCadeau'],$row['lienCadeau'], $row['idCadeau'], $row['acheteCadeau']);
            array_push($this->sesCadeaux, $cadeau);
        }
        //met a jour la session
        $_SESSION['sesCadeaux']= $this->sesCadeaux;
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
        //met a jour la session
        $_SESSION['sesGroupesAdmin']= $this->sesGroupesAdmin;
        return $this->sesGroupesAdmin;
    }
//FONCTION POUR OBTENIR LA LISTE DES GROUPE DONT LE MEMBRE FAIT PARTIE
    function getSesGroupesMembre(){
        $requete = "SELECT groupe.idGroupe, nomGroupe,groupe.idUser FROM groupe , appartient WHERE appartient.idUser='$this->id' AND appartient.idGroupe=groupe.idGroupe";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));
        while($row = mysqli_fetch_assoc($result)){
            $groupe = new Groupe($row['idGroupe'], $row['nomGroupe'], $row['idUser']);
            array_push($this->sesGroupesMembre, $groupe);
        }
        //met a jour la session
        $_SESSION['sesGroupesMembre']= $this->sesGroupesMembre;
        return $this->sesGroupesMembre;
    }
//FONCTION D'AJOUT D'UN NOUVEAU CADEAU A SA LISTE DE CADEAUX SOUHAITE
    function ajouterCadeau($nom, $desc, $img, $lien, $idUser) {

        //$desc = NULL;
        $img = NULL ;
       //    $lien = NULL;

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


//FONCTION POUR OBTENIR LA LISTE DES MEMBRES INACTIFS QUE LE MEMBRE A CREE
    function getSesInactifs() {
        $requete = "SELECT idUser, nomUser, prenomUser FROM users NATURAL JOIN userinactif WHERE idUser_useractif = '$this->id'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));
        while($row = mysqli_fetch_assoc($result)){
            $membre = new Membre($row['nomUser'], $row['prenomUser'], $row['idUser'], $this->id);
            array_push($this->sesInactifs, $membre);
        }
        //met a jour la session
        $_SESSION['sesInactifs']= $this->sesInactifs;
        return $this->sesInactifs;
    }

//FONCTION POUR AJOUTER UN MEMBRE INACTIF A MA LISTE D'INACTIFS
    function ajouterInactif($nom , $prenom, $idCreateur, $sesGroupes){
        
        $requete1 = "INSERT INTO USERS (nomUser, prenomUser)VALUES ('$nom', '$prenom')" ;
        $result = mysqli_query($this->co, $requete1)  or die ("Exécution de la requête insert1 impossible ".mysqli_error($this->co));
        $requete2 = "INSERT INTO USERINACTIF SELECT idUser, '$idCreateur' FROM USERS WHERE idUser = LAST_INSERT_ID()";
        $result = mysqli_query($this->co, $requete2)  or die ("Exécution de la requête insert2 impossible ".mysqli_error($this->co));
        
        foreach ($sesGroupes as $groupeID){
            $requete = "INSERT INTO appartient (idGroupe, idUser) VALUES ($groupeID, LAST_INSERT_ID())" ;
            $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert dans APPARTIENT impossible ".mysqli_error($this->co));
        }

        return $this->getSesInactifs(); 
    }
//FONCTION DE SUPPRESSION D'UN MEMBRE INACTIF 
    function supprimerInactif($id){
        $requete1 = "DELETE FROM users Where idUser = $id" ;
        $result = mysqli_query($this->co, $requete1)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        $requete2 = "DELETE FROM userinactif Where idUser = $id" ;
        $result = mysqli_query($this->co, $requete2)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        

        $requete3 = "SELECT idUser FROM appartient Where idUser = $id" ;
        $result = mysqli_query($this->co, $requete3)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));

        while($row = mysqli_fetch_assoc($result)){
            $requete = "DELETE FROM appartient Where idUser = $id" ;
            $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        }

        return $this->getSesInactifs();
    }

//trouver le nom et prenom en fonction de ID
    function trouverNomPrenom(){
      $requete = "SELECT nomUser,prenomUser FROM USERS WHERE idUser = $this->id" ;
      $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
      while($row = mysqli_fetch_assoc($result)){
          $this->nom=$row['nomUser'];
          $this->prenom=$row['prenomUser'];
      }
    }

    //FIN CLASSE

}
?>
