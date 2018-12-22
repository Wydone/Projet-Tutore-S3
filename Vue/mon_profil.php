<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
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
            echo $_SESSION['email']."<br>".$_SESSION['nom']."<br>".$_SESSION['prenom'];
        }

        if(isset($mdpModifie)){
            echo "<br>mot de passe modifié <br>"; //gérer cette option 
        }
    ?>
            <form action="..\Controleur\modifier_mdp.php" method="post">
                <label for ="mdp"> Nouveau mot de passe : </label>
                <input type="texte" name="mdp" value="" />
                 <br>
                <label for ="verifmdp"> Confirmer mot de passe :  </label>
                <input type="password" name="verfimdp" value=""/>
                <br>
    
                <input type="submit" value="Modifier"/>
            </form>
    
    <h1>Mes souhaits</h1>
    <?php 
        
        foreach($sesCadeaux as $cadeau){
            
            echo "cadeau : ".$cadeau->getNom()."<br>" ; 
        }
        
    ?>
    <h1>Groupes que j'administre</h1>
    <?php 
        
        foreach($sesGroupesAdmin as $groupe){
            
            echo "groupe : ".$groupe->getNom()."<br>" ; 
        }
        
    ?>
</body>
</html>