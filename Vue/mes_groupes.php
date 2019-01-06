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



          <!--<a href="#" >
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
          </a>-->



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


          $sesInactifs=$_SESSION['sesInactifs'];
          $inactif =0;

          $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
          foreach($sesGroupesMembre as $groupe){
            if ($_SESSION['idLastGroupe']==$groupe->getID()) {
                  echo   '<article id="'.$groupe->getID().'" class="col membres visible">';
            }else{
              echo   '<article id="'.$groupe->getID().'" class="col membres invisible">';
            }
                  $sesMembres=array();
                  $requete = "SELECT idUser, nomUser, prenomUser FROM appartient NATURAL JOIN users WHERE idGroupe='".$groupe->getID()."'";
                  $result = mysqli_query($co, $requete) or die ("Exécution de la requête recherche impossible ".mysqli_error($co));
                  while($row = mysqli_fetch_assoc($result)){
                        $membre = new Membre($row['idUser']);
                        //affichage d'un membre:

                        foreach($sesInactifs as $membre_inactif){

                          if ( $membre_inactif->getID() == $membre->getID()) {

                            $inactif= $inactif+1;

                          }
                        }

                        echo '<div class=" col-sm-4 un-membre">';
                          echo '<div class="entete">';
                              echo '<i class="fas fa-user-circle"></i><br />';
                              echo '<h2>'.$membre->getNom().' ' .$membre->getPrenom(). '</h2>';
                          echo '</div>';
                          if ($inactif>0 or $membre->estInactif($membre->getID())>0 ) {
                            $sesCadeaux=$membre->getSesCadeauxInactif($membre->getID());
                          }else {
                            $sesCadeaux=$membre->getSesCadeaux();
                          }

                          //table de cadeaux

                          echo '<div class="table-cadeaux">';
                            echo '<table>';
                            foreach($sesCadeaux as $cadeau){
                              echo '<tr>';



                                if ($inactif>0) {//completer pour mes membres inactifs


                                  $requeteListe2 = "SELECT idListe, idCadeau FROM contient WHERE idCadeau='".$cadeau->getID()."'" ;//listeid = idgroupe
                                  $resultListe2 = mysqli_query($co, $requeteListe2)  or die ("Exécution de la requête insert impossible ".mysqli_error($co));
                                  $countline2 =mysqli_num_rows($resultListe2);
                                  if ($countline2>0) {//contient a idgroupe idcadeau
                                    while ($rowListe2 = mysqli_fetch_assoc($resultListe2)) {

                                      if ($rowListe2['idListe']==$groupe->getID()) {
                                        if ($cadeau->getAchete()==1) {

                                          echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=0&idgroupe='.$groupe->getID().'"><i class="fas fa-check-square"></i></a></td>';
                                          echo '<td class="barrer vert">'.$cadeau->getNom().'</td>';//dans la liste et acheter
                                        }else {

                                          echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=1&idgroupe='.$groupe->getID().'"><i class="far fa-square"></i></a></td>';
                                          echo '<td class="vert">'.$cadeau->getNom().'</td>';//dans la liste pas acheter
                                        }
                                        // si le cadeau appartient à ce groupe alors on peut le suppr

                                        echo '<td><a href="../Controleur/supprimer_cadeau_membre.php?id='.$cadeau->getID().'&idgroupe='.$groupe->getID().'"><p>Supprimer</p></a></td>';
                                      }else {
                                        if ($cadeau->getAchete()==1) {

                                          echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=0&idgroupe='.$groupe->getID().'"><i class="fas fa-check-square"></i></a></td>';
                                          echo '<td class="barrer">'.$cadeau->getNom().'</td>';//dans un groupe et acheter
                                        }else {

                                          echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=1&idgroupe='.$groupe->getID().'"><i class="far fa-square"></i></a></td>';
                                          echo '<td class="barrer">'.$cadeau->getNom().'</td>';//dans un groupe pas acheter
                                        }
                                        // code...

                                        echo '<td><a href="#"><p>Deja un groupe</p></a></td>';
                                      }

                                    }



                                  }else {//sinon demande d'ajout'
                                    echo '<td>'.$cadeau->getNom().'</td>';
                                    echo '<td><a href="../Controleur/ajouter_cadeau_membre.php?id='.$cadeau->getID().'&idgroupe='.$groupe->getID().'"><p>Ajouter au groupe</p></a></td>';

                                  }


                                  //si cadeau acheter (acheteCadeau==1) alors barrer cadeau +image ok
                                  /*if ($cadeau->getAchete()==1) {
                                    echo '<td class="barrer">'.$cadeau->getNom().'</td>';
                                    echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=0&idgroupe='.$groupe->getID().'"><i class="fas fa-check-square"></i></a></td>';
                                  }else {
                                    echo '<td>'.$cadeau->getNom().'</td>';
                                    echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=1&idgroupe='.$groupe->getID().'"><i class="far fa-square"></i></a></td>';
                                  }
                                echo '<td><a href="../Controleur/supprimer_cadeau_mes_groupes.php?id='.$cadeau->getID().'"><i class="fas fa-trash-alt"></i></a></td>';*/









                                //SI L'UTILISATEUR POSSEDE/est CE MEMBRE
                              }elseif ($membre->getID()==$_SESSION['id']) {

///////////////////////
//GESTION DES CADEAUX DE L'UTILISATEUR DANS UN GROUPE
///////////////////////


                                //supprimer a tout jamais
                                /*echo '<td><a href="../Controleur/supprimer_cadeau_mes_groupes.php?id='.$cadeau->getID().'"><i class="fas fa-trash-alt"></i></a></td>';*/

                                $requeteListe = "SELECT idListe, idCadeau FROM contient WHERE idCadeau='".$cadeau->getID()."'" ;//listeid = idgroupe
                                $resultListe = mysqli_query($co, $requeteListe)  or die ("Exécution de la requête insert impossible ".mysqli_error($co));
                                $countline =mysqli_num_rows($resultListe);

                                //permet d'ajouter un cadeau dans ce groupe




                                if ($countline>0) {//contient a idgroupe idcadeau
                                  while ($rowListe = mysqli_fetch_assoc($resultListe)) {

                                    if ($rowListe['idListe']==$groupe->getID()) {
                                      // si le cadeau appartient à ce groupe alors on peut le suppr
                                      echo '<td class="vert">'.$cadeau->getNom().'</td>';
                                      echo '<td><a href="../Controleur/supprimer_cadeau_membre.php?id='.$cadeau->getID().'&idgroupe='.$groupe->getID().'"><p>Supprimer</p></a></td>';
                                    }else {
                                      // code...
                                      echo '<td class="barrer">'.$cadeau->getNom().'</td>';
                                      echo '<td><a href="#"><p>Deja un groupe</p></a></td>';
                                    }
                                  }



                                }else {//sinon demande d'ajout'
                                  echo '<td>'.$cadeau->getNom().'</td>';
                                  echo '<td><a href="../Controleur/ajouter_cadeau_membre.php?id='.$cadeau->getID().'&idgroupe='.$groupe->getID().'"><p>Ajouter au groupe</p></a></td>';

                                }


                                //SI C4EST JUSTE UN MEMBRE DU GROUPE
                              }else {



                                $requeteListe2 = "SELECT idListe, idCadeau FROM contient WHERE idListe='".$groupe->getID()."' AND idCadeau='".$cadeau->getID()."'" ;//listeid = idgroupe
                                $resultListe2 = mysqli_query($co, $requeteListe2)  or die ("Exécution de la requête insert impossible ".mysqli_error($co));
                                $countline2 =mysqli_num_rows($resultListe2);

                                // superieur a 0 alors on affiche sinon on affiche pas
                                if ($countline2>0) {
                                  if ($cadeau->getAchete()==1) {
                                    echo '<td class="barrer">'.$cadeau->getNom().'</td>';
                                    echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=0&idgroupe='.$groupe->getID().'"><i class="fas fa-check-square"></i></a></td>';
                                  }else {
                                    echo '<td>'.$cadeau->getNom().'</td>';
                                    echo '<td><a href="../Controleur/cocher_cadeau.php?id='.$cadeau->getID().'&newetat=1&idgroupe='.$groupe->getID().'"><i class="far fa-square"></i></a></td>';
                                  }
                                }else {
                                  // on affiche pas
                                }


                              }
                              echo '</tr>';
                            }
                            $inactif=0;
                            echo '</table>';
                           echo '</div>';
                           //si l'user et le membre son la meme personne
                           if ($membre->getID()==$_SESSION['id']) {
                             echo '<div>';
                             echo '<a href="../Vue/mon_profil.php"><button class="btn-membre">Ajouter un cadeau</button></a>';
                              /*echo '<div id="ajout-cadeau-membre" class="ajout-cadeau-membre invisible">';
                                echo '<h2>test</h2>';
                              echo '</div>';*/
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
                //droit de supprimer le groupe
                if ($groupe->getCreateur()==$_SESSION['id']) {
                  echo '<div class="col-sm-4 add-membre">';
                    echo '<div class="center-membre">';
                        echo '<button onclick="visible_suppr_groupe()"><p>Supprimer le<br/>Groupe</p></button>';
                    echo '</div>';
                  echo '</div>';
              }



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
    <input class="invisible" id="ajout-membre-input" type="text" name="ajout-membre-input" value="<?php echo $_SESSION['idLastGroupe'];?>">
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

<div id="supprimer-groupe" class="supprimer-groupe invisible">
  <h2>Suppression Groupe</h2>
  <p>Etes-vous sûr de vouloir supprimer le groupe?</p>
  <form class="" action="../Controleur/supprimer_groupe.php" method="post">
    <input class="invisible" id="supprimer-groupe-input" type="text" name="supprimer-groupe-input" value="<?php echo $_SESSION['idLastGroupe'];?>">
    <input type="submit" value="Supprimer">
  </form>
    <button type="button" name="annuler" onclick="invisible_suppr_groupe()">Annuler</button>
</div>

<!--<div id="ajout-cadeau-membre" class="ajout-cadeau-membre invisible">
  <h2>Ajouter des Cadeaux</h2>
  <p>Voici vos cadeaux non distribués</p>
  <form class="" action="../Controleur/ajout_cadeau_membre.php" method="post">
    <input class="invisible" id="ajout-cadeau-membre-input" type="text" name="ajout-cadeau-membre-input" value="">
    <input type="submit" value="Ajout">
  </form>
    <button type="button" name="annuler" onclick="invisible_ajoutcadeaumembre()">Annuler</button>
</div>-->


<script type="text/javascript">
      function load_GroupebyId(id) {
          for( var i= 0; i< 1000;i++){
            try{
            document.getElementById(i).className ="col membres invisible";
          }catch(err){}
          }
           document.getElementById(id).className = "col membres visible";
           document.getElementById("ajout-membre-input").setAttribute("value",id);
           document.getElementById("supprimer-groupe-input").setAttribute("value",id);

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
      function invisible_suppr_groupe(){
        document.getElementById("supprimer-groupe").className = "nouveau-groupe invisible";
      }
      function visible_suppr_groupe(){
        document.getElementById("supprimer-groupe").className = "nouveau-groupe visible";
      }

      function invisible_ajoutcadeaumembre(){
        document.getElementById("ajout-cadeau-membre").className = "ajout-cadeau-membre invisible";
      }
      function visible_ajoutcadeaumembre(id){
        document.getElementById("ajout-cadeau-membre").className = "ajout-cadeau-membre visible";
        document.getElementById("ajout-cadeau-membre-input").setAttribute("value",id);
      }
</script>

<?php include'Composant/footer.php';?>


  <!--JavScript and Jquery-->
  <?php include'Composant/body_script.php';?>
  </body>
</html>
