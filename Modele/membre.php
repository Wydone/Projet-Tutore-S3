<?php
    require_once('connect.php');

    public function connexion(){
        session_start();
        $_SESSION['login']= $_POST['login'];  
        $_SESSION['mdp']= $_POST['mdp'];
        $_SESSION['login']= $_POST['login'];
        $_SESSION['login']= $_POST['login'];
       
    }
?>