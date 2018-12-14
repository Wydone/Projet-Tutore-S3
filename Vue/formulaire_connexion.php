<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>formulaire_connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>FORMULAIRE CONNEXION</h1>

<form action="..\Controleur\connexion.php" method="post">
    <label for ="pseudo"> login : </label>
    <input type="texte" name="login" value="" />
    <br>
    <label for ="mdp"> Mot de passe : </label>
    <input type="password" name="mdp" value=""/>
    <br>
    
    <input type="submit" value="Se connecter"/>
</form>
</body>
</html>