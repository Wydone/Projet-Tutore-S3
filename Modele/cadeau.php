<?php 

class Cadeau{
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

 
}

?>