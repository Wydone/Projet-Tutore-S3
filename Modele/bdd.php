<?php 
   
    class bd {
        private $host; 
        private $user; 
        private $bdd ; 
        private $passwd;
        private $co ;

        function __construct(){
            $this->host = "localhost" ; 
            $this->user = "root" ; 
            $this->bdd = "projet_tutore_s3" ; 
            $this->passwd = "" ; 
        }

        function connect() {
            $this->co = mysqli_connect($this->host , $this->user , $this->passwd, $this->bdd) or die("erreur de connexion".mysqli_error($this->co));
           
       }
       function deconnect(){
           mysqli_close($this->co);  
       }
       function getBd(){
           return $this->bd; 
       }
       public function getConnexion(){
           return $this->co; 
       }
    }
?>