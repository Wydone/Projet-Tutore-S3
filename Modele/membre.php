<?php
    require_once('..\Modele\bdd.php');
    require_once('..\Modele\cadeau.php');
    require_once('..\Modele\groupe.php');
class Membre{
    
    private $co ; 
    private $id ; 
    private $nom ; 
    private $prenom ; 
    private $login; 
    private $mdp;
    private $email; 

    private $sesCadeaux; //la liste de ses cadeaux souhaité
    private $sesGroupesAdmin; //la liste des groupes qu'il administre

          
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

    function deconnexion() {
        session_destroy() ; 
        mysqli_close($this->connect);   
    } 

    function verifInfos($login, $mdp){
      
       
        $requete = "SELECT idUser FROM useractif WHERE loginUser='$login' AND passwordUser= '$mdp'"; 
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));
        
        if(mysqli_num_rows($result) == 1){
            return true ; 
        }else {
            return false ; 
        }
    }

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

    function modifierMdp($mdp){
        $this->mdp = $mdp ; 
        $requete = "UPDATE useractif SET passwordUser = '$this->mdp' WHERE idUser = '$this->id'" ; 
        $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        
        return true ; 
    }

    function getSesCadeaux(){
        $requete = "SELECT * FROM cadeau NATURAL JOIN users NATURAL JOIN useractif WHERE idUser='$this->id'"; 
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co)); 
        
        while($row = mysqli_fetch_assoc($result)){
            $cadeau = new Cadeau($this->id, $row['nomCadeau'], $row['descriptionCadeau'],$row['imageCadeau'],$row['lienCadeau']); 
            array_push($this->sesCadeaux, $cadeau); 
        }
              
        return $this->sesCadeaux; 
    } 

    function getSesGroupesAdmin(){
        $requete = "SELECT idGroupe, nomGroupe FROM groupe NATURAL JOIN users NATURAL JOIN useractif WHERE idUser='$this->id'"; 
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co)); 
        
        while($row = mysqli_fetch_assoc($result)){
            $groupe = new Groupe($row['idGroupe'], $row['nomGroupe'], $this->id);
            array_push($this->sesGroupesAdmin, $groupe); 
        }
        return $this->sesGroupesAdmin; 
    }

    function getCo() {
        return $this->co ; 
    }
    function getNom() {
        return $this->nom ;
    }

    function ajouterCadeau($nom, $desc, $img, $lien) {
        $cadeau = new Cadeau($this->id, $nom, $desc, $img, $lien);
        

       
        $requete = "INSERT INTO Cadeau (nomCadeau, descriptionCadeau, imageCadeau, lienCadeau, acheteCadeau, idUser, idUser_acheteur )VALUES ('$nom', '$desc', '$img', '$lien',false, '$this->id', null )" ; 
        $result = mysqli_query($this->co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($this->co));
        
        return $this->getSesCadeaux(); 
    }
  
}


?>