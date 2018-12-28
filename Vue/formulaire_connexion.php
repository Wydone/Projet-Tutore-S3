<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>formulaire_connexion</title>
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
          <h2 class="center margin-h2-b">Se connecter</h2>


          <form class="box-connect" action="..\Controleur\connexion.php" method="post">
              <!--<label for ="pseudo"> login : </label><br>-->
              <input type="text" name="login" placeholder="Login" value="" />
              <br>
              <!--<label for ="mdp"> Mot de passe : </label><br>-->
              <input type="password" name="mdp" placeholder="Mot de passe" value=""/>
              <br>
              <div class="container">
                <div class="row">
                  <div class="col">
                    <a href="..\Vue\formulaire_inscription.php" >S'inscrire</a>

                   </div>
                   <div class="col">
                      <input type="submit"  value="Se connecter"/>
                  </div>

                 </div>
                </div>
                <div class="container">
                  <div class="row box-checkbox">

                    <p>Rester connecté </p>
                    <input type="checkbox" class="switch" name="" value="">

                  </div>
                </div>

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
