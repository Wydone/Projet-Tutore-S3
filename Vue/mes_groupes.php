<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mes Groupes</title>

    <?php include'Composant/meta.php';?>
  </head>
  <body class="full">
  <?php include'Composant/class.php';//contient les class du modele ?>
	<?php include'Composant/navbar_connect.php';//contient la session start?>


<section class="padding-page full-screen">

  <div class="fluid-container full-screen">
    <div class="row margin-zero full-screen">
      <div class="col-lg-3 groupes full-div">
          <a href="#">
            <div class="un-groupe">
              <h2>Nom groupe</h2>
            </div>
          </a>
          <a href="#">
            <div class="un-groupe">
                <h2>Nom groupe</h2>
            </div>
          </a>
          <a href="#">
            <div class="un-groupe">
                <h2>Nom groupe</h2>
            </div>
          </a>




          <button>
            <div class="un-groupe">
                <h2>Nom groupe</h2>
            </div>
          </button>
      </div>
      <div class="col membres">
        <div class="un-membre">
              <h2>test</h2>
        </div>
      </div>

    </div>
  </div>


</section>


<?php include'Composant/footer.php';?>


  <!--JavScript and Jquery-->
  <?php include'Composant/body_script.php';?>
  </body>
</html>
