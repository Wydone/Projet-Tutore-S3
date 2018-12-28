<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>formulaire_inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include'Composant/meta.php';?>
</head>
<body>
    <?php include'Composant/navbar.php'; ?>

<section class="banner cadeau background">
    <div class="container">
      <div class="row">
        <div class="col">
        </div>
        <div class="col-6 ">
          <h2 class="center margin-h2-b">FORMULAIRE INSCRIPTION</h2>

<form class="box-connect" action="..\Controleur\inscription.php" method="post">
    <!--<label for ="email"> Adresse email : </label>-->
    <input class="input-text" type="texte" name="email" value="" placeholder="E-mail"/>
    <br>
    <!--<label for ="nom"> Nom : </label>-->
    <input type="text" name="nom" value="" placeholder="Nom"/>
    <br>
    <!--<label for ="prenom"> Prenom : </label>-->
    <input class="input-text" type="texte" name="prenom" value="" placeholder="Prénom"/>
    <br>
    <!--<label for ="login"> Login : </label>-->
    <input class="input-text" type="texte" name="login" value="" placeholder="Login"/>
    <br>
    <!--<label for ="mdp"> Mot de passe : </label>-->
    <input type="password" name="mdp" value="" placeholder="Mot de passe"/>
    <br>
    <!--<label for ="verifMdp"> Vérif mot de passe : </label>-->
    <input type="password" name="verifMdp" value="" placeholder="Vérification Mot de passe"/>
    <br>
    <input type="submit" value="Créer un compte"/>
</form>
</div>
<div class="col">
</div>
</div>

</div>
</section>



<?php include'Composant/footer.php';?>
<?php include'Composant/body_script.php';?>

</body>
</html>
