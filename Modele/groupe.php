<?php

class Groupe {
    private $co ;
    private $id ;
    private $nom ;
    private $createur ;
    private $sesMembres ;

    function __construct(){
      $bd = new bd();
      $bd->connect();
      $this->co = $bd->getConnexion() ;
        $this->id = func_get_arg(0);
        $this->nom = func_get_arg(1);
        $this->createur = func_get_arg(2);
        $this->sesMembres =  array();
    }

    function getNom() {
        return $this->nom ;
    }
    function getID() {
        return $this->id;
    }

    function getSesMembres(){
        $requete = "SELECT idUser, nomUser, prenomUser FROM appartient NATURAL JOIN users WHERE idGroupe='$this->id'";
        $result = mysqli_query($this->co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($this->co));
        while($row = mysqli_fetch_assoc($result)){
            $membre = new Membre($row['idUser']);
            array_push($this->sesMembres, $membre);
        }

        return $this->sesMembres;
    }
}
?>
