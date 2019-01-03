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


        <?php
        $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
        foreach($sesGroupesMembre as $groupe){

          echo '<a onclick="load_GroupebyId('.$groupe->getID().')" href="#" >';
            echo '<div class="un-groupe">';
              echo '<div class="row margin-zero">';
                echo '<p><i class="fas fa-users"></i>'.$groupe->getNom().'</p>';
              echo '</div>';
            echo '</div>';
          echo '</a>';
        }

        ?>



          <a href="#" >
            <div class="un-groupe">
              <div class="row margin-zero">

                <p><i class="fas fa-users"></i>Nom groupe</p>
              </div>

            </div>
          </a>



          <a href="#">
            <div class="un-groupe">
              <div class="row margin-zero">

                <p><i class="fas fa-exclamation-circle"></i>Nom groupe</p>
              </div>

            </div>
          </a>



          <a href="#">
            <div class="un-groupe">
                <h2>test</h2>
            </div>
          </a>



          <button>
            <div class="un-groupe">
                <h2>Nouveau groupe</h2>
            </div>
          </button>
      </div>

<!--L'affichage du groupe-->



          <?php
          $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
          foreach($sesGroupesMembre as $groupe){
              echo   '<article id="'.$groupe->getID().'" class="col membres invisible">';
                echo '<div class="un-membre">';
                  echo '<h2>'.$groupe->getNom().'</h2>';
                echo '</div>';
              echo '</article>';

          }
          ?>

          <article class="col membres">





            <div class=" col-sm-4 un-membre">
              <div class="entete">
                  <i class="fas fa-user-circle"></i><br />
                  <h2>nom du membre</h2>
              </div>
              <div class="table-cadeaux">
                <table>
                  <tr>
                    <td>son-cadeau</td>
                    <td><i class="fas fa-trash-alt"></i></td>
                  </tr>
                  <tr>
                    <td>son-2cadeau</td>
                    <td><i class="fas fa-trash-alt"></i></td>
                  </tr>
                </table>
              </div>

              <h2 id="2">test</h2>
              <h2 id="2">test</h2>




            </div>
            <div class="col-sm-4 un-membre">
              <h2 id="2">test</h2>

            </div>
            <div class=" col-sm-4 un-membre">
              <h2 id="2">test</h2>

            </div>
            <div class=" col-sm-4 un-membre">
              <h2 id="2">test</h2>
            </div>


            <div class="col-sm-4 add-membre">
              <div class="center-membre">
                  <button><i class="fas fa-plus"></i></button>
              </div>

            </div>
          </article>

    </div>
  </div>


</section>

<script type="text/javascript">
      function load_GroupebyId(id) {
          for( var i= 0; i< 1000;i++){
            try{
            document.getElementById(i).className ="col membres invisible";
          }catch(err){}
          }
           document.getElementById(id).className = "col membres visible";
        }
</script>

<?php include'Composant/footer.php';?>


  <!--JavScript and Jquery-->
  <?php include'Composant/body_script.php';?>
  </body>
</html>
