<?php 
 require_once('..\Modele\bdd.php');

class Cadeau{
    private $id ;
    private $idUser;
    private $nom ; 
    private $desc ; 
    private $img ; 
    private $lien ; 
    private $achete ; 

    function __construct() {
      
        $this->idUser = func_get_arg(0); 
        $this->nom = func_get_arg(1);
        $this->desc = func_get_arg(2);
        $this->img = func_get_arg(3);
        $this->lien = func_get_arg(4);
       // $this->achete = func_get_arg(5);
    }

    function getNom() {
        return $this->nom ; 
    }
    function getDesc() {
        return $this->desc; 
    }
    function setID() {
        $bd = new bd(); 
        $bd->connect(); 
        $co = $bd->getConnexion() ; 
        
        $requete = "SELECT idCadeau FROM Cadeau WHERE nomCadeau = $this->nom AND descriptionCadeau = $this->desc AND imageCadeau = $this->img AND lienCadeau = $this->lien AND idUser = $this->idUser" ; 
        $result = mysqli_query($co, $requete)  or die ("Exécution de la requête insert impossible ".mysqli_error($co)); 
        while($row = mysqli_fetch_assoc($result))
        {
            $this->id = $row['idCadeau']; 
        }    
    }
    function getID() {
        return $this->id; 
    }
    

    
 
}

?>