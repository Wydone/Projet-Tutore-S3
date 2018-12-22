<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

    <h1>Mes infos</h1>
    <?php 
        
        if(!isset($_SESSION['nom'])){
            echo "error"; 
        }else {
            echo "Hello ".$_SESSION['nom'] ." ".$_SESSION['prenom'];
        }
    ?> 
    <h1>Mes souhaits</h1>
    <?php 
        
        foreach($sesCadeaux as $cadeau){
            
            echo "cadeau : ".$cadeau->getNom()."\n" ; 
        }
        
    ?>
    <h1>Groupes que j'administre</h1>

</body>
</html>