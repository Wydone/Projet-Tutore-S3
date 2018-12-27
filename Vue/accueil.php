<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">

    <link rel="stylesheet" href="../Style/bootstrap.min.css">

    <link rel="stylesheet" href="../Style/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>

	<?php include'Composant/navbar.php';?>

  <section class="banner">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h2>Lorem ipsum dolor sit amet</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>

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
        </div>

      </div>
  </section>

	<h1>test</h1>








	<?php include'Composant/footer.php';?>



  <!--JavScript and Jquery-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
