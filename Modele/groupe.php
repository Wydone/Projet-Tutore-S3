<?php

class Groupe {

    private $id ; 
    private $nom ; 
    private $createur ; 
   // private $sesMembres ; 

    function __construct(){
        $this->id = func_get_arg(0);
        $this->nom = func_get_arg(1); 
        $this->createur = func_get_arg(2);
       // $this->sesMembres =  array();   
    }

    function getNom() {
        return $this->nom ; 
    }
    
    function getIdGroupe() {
        return $this->id ; 
    }

}
?>