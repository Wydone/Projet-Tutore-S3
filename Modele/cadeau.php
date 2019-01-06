<?php
 require_once('..\Modele\bdd.php');

class Cadeau{

//ATTRIBUTS DE LA CLASSE
    private $id ;
    private $idUser;
    private $nom ;
    private $desc ;
    private $img ;
    private $lien ;
    private $achete ;

//------------------------
//CONSTRUCTEUR DE CADEAUX
//------------------------
    function __construct() {

        $this->idUser = func_get_arg(0);
        $this->nom = func_get_arg(1);
        $this->desc = func_get_arg(2);
        $this->img = func_get_arg(3);
        $this->lien = func_get_arg(4);
        $this->id = func_get_arg(5);
        $this->achete = func_get_arg(6);


    }

//----------------
//  GETTERS
//----------------
    function getNom() {
        return $this->nom ;
    }
    function getDesc() {
        return $this->desc;
    }
    function getID() {
        return $this->id;
    }

    function getAchete() {
        return $this->achete;
    }
    //----------------
    //  FONCTIONS
    //----------------

}

?>
