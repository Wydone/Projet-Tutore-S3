<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>formulaire_inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>FORMULAIRE INSCRIPTION</h1>

<form action="..\Controleur\inscription.php" method="post">
    <label for ="email"> Adresse email : </label>
    <input type="texte" name="email" value="" />
    <br>
    <label for ="nom"> Nom : </label>
    <input type="text" name="nom" value="" />
    <br>
    <label for ="prenom"> Prenom : </label>
    <input type="texte" name="prenom" value=""/>
    <br>
    <label for ="login"> Login : </label>
    <input type="texte" name="login" value=""/>
    <br>
    <label for ="mdp"> Mot de passe : </label>
    <input type="password" name="mdp" value=""/>
    <br>
    <label for ="verifMdp"> Vérif mot de passe : </label>
    <input type="password" name="verifMdp" value=""/>
    <br>
    <input type="submit" value="Créer un compte"/>
</form>
</body>
</html>