<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <?php include'Composant/meta.php';?>
  </head>
  <body>

	<?php include'Composant/navbar.php';?>

  <section class="banner">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h2>Noël arrive, Preparez vous!?</h2>
            <p class="intro">Pour ce Noël, Partagez avec votre famille et vos proches ce que vous souhaiteriez recevoir et offrez leur ce qu'ils souhaitent depuis toujours. Connectez vous et rendez ce Noël inoubliable.
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


<section class="sec2"></section>


<section class="fonctionnality">
  <div class="container">
      <h1 id="fonctionnalitees">Fonctionnalitées</h1>
    <div class="row">


    </div>

  </div>
</section>



<i class="fas fa-gift"></i>







	<?php include'Composant/footer.php';?>



  <!--JavaScript and Jquery-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
