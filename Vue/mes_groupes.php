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



          <button onclick="visible_nouveaugroupe()">
            <div class="un-groupe">
                <h2>Nouveau groupe</h2>
            </div>
          </button>
      </div>

<!--L'affichage du groupe-->



          <?php
          $bd = new bd();
          $bd->connect();
          $co = $bd->getConnexion() ;

          $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
          foreach($sesGroupesMembre as $groupe){
              echo   '<article id="'.$groupe->getID().'" class="col membres invisible">';
                  $sesMembres=array();
                  $requete = "SELECT idUser, nomUser, prenomUser FROM appartient NATURAL JOIN users WHERE idGroupe='".$groupe->getID()."'";
                  $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
                  while($row = mysqli_fetch_assoc($result)){
                        $membre = new Membre($row['idUser']);
                        //affichage d'un membre:
                        echo '<div class=" col-sm-4 un-membre">';
                          echo '<div class="entete">';
                              echo '<i class="fas fa-user-circle"></i><br />';
                              echo '<h2>'.$membre->getNom().' ' .$membre->getPrenom(). '</h2>';
                          echo '</div>';
                          $sesCadeaux=$membre->getSesCadeaux();
                          //table de cadeaux

                          echo '<div class="table-cadeaux">';
                            echo '<table>';
                            foreach($sesCadeaux as $cadeau){
                              echo '<tr>';
                                echo '<td>'.$cadeau->getNom().'</td>';
                                echo '<td><a href="supprimer_cadeau_mes_groupes.php?id='.$cadeau->getID().'"><i class="fas fa-trash-alt"></i></a></td>';
                              echo '</tr>';
                            }
                            echo '</table>';
                           echo '</div>';
                           //si l'user et le membre son la meme personne
                           if ($membre->getID()==$_SESSION['id']) {
                             echo '<div>';
                             echo '<button class="un-groupe">Ajouter un cadeau</button>';
                             echo '</div>';
                           }


                        echo '</div>';
                        array_push($sesMembres, $membre);
                  }
                /*echo '<div class=" col-sm-4 un-membre">';
                  echo '<h2>'.$groupe->getNom().'</h2>';*/
                  /*echo '<h2>'.$groupe->getSesMembres().'</h2>';*/

                //affichage du button +
                echo '<div class="col-sm-4 add-membre">';
                  echo '<div class="center-membre">';
                      echo '<button onclick="visible_ajoutmembre()"><i class="fas fa-plus"></i></button>';
                  echo '</div>';
                echo '</div>';





              echo '</article>';




          }
          ?>
          <!--
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
                </table>
               </div>
             </div>

            <div class="col-sm-4 un-membre">
              <h2 id="2">test</h2>
            </div>

            <div class="col-sm-4 add-membre">
              <div class="center-membre">
                  <button><i class="fas fa-plus"></i></button>
              </div>
            </div>
          </article>-->

    </div>
  </div>
</section>


<div id="ajout-membre" class="ajout-membre invisible">
  <h2>Ajouter un membre</h2>
  <form class="" action="../Controleur/ajouter_membre.php" method="post">
    <input type="text" name="email" value="" placeholder="e-mail"><br/>
    <input class="invisible" id="ajout-membre-input" type="text" name="ajout-membre-input" value="">
    <input type="submit" value="Ajouter">
  </form>
    <button type="button" name="annuler" onclick="invisible_ajoutmembre()">Annuler</button>
</div>

<div id="nouveau-groupe" class="nouveau-groupe invisible">
  <h2>Nouveau Groupe</h2>
  <form class="" action="../Controleur/nouveau_groupe.php" method="post">
    <input type="text" name="titre" value="" placeholder="Titre"><br/>
    <input type="submit" value="Ajouter">
  </form>
    <button type="button" name="annuler" onclick="invisible_nouveaugroupe()">Annuler</button>
</div>


<script type="text/javascript">
      function load_GroupebyId(id) {
          for( var i= 0; i< 1000;i++){
            try{
            document.getElementById(i).className ="col membres invisible";
          }catch(err){}
          }
           document.getElementById(id).className = "col membres visible";
           document.getElementById("ajout-membre-input").setAttribute("value",id);
        }

      function invisible_ajoutmembre(){
        document.getElementById("ajout-membre").className = "ajout-membre invisible";
      }
      function visible_ajoutmembre(){
        document.getElementById("ajout-membre").className = "ajout-membre visible";
      }

      function invisible_nouveaugroupe(){
        document.getElementById("nouveau-groupe").className = "nouveau-groupe invisible";
      }
      function visible_nouveaugroupe(){
        document.getElementById("nouveau-groupe").className = "nouveau-groupe visible";
      }

</script>

<?php include'Composant/footer.php';?>


  <!--JavScript and Jquery-->
  <?php include'Composant/body_script.php';?>
  </body>
</html>
