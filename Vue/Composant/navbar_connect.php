<?php session_start(); ?>
<nav class="shadow navbar navbar-red navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#"><img class="logo" src="../Image/logo.png"/></a>

<!--icon site-->
  <button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
			aria-label="Toggle navigation">
   	<span class="navbar-toggler-icon"></span>
  </button>

<!--menu gauche-->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

      <!--grand ecran-->

      <li class="nav-item visible-grand-ecran">
        <a class="nav-link" href="../Vue/mes_groupes.php">Mes groupes </a>
      </li>

      <!--petit ecran-->

      <li class="nav-item visible-petit-ecran">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mes groupes<span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php

          /*foreach($sesGroupesAdmin as $groupe){

              echo '<a class="dropdown-item" href="#">groupe Ad : '.$groupe->getNom()."</a>" ;
          }*/

          //ce qu'on veut afficher
          $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
          foreach($sesGroupesMembre as $groupe){

              echo '<a class="dropdown-item" href="../Controleur/load_groupe.php?idgroupe='.$groupe->getID().'">'.$groupe->getNom()."</a>" ;
          }

          ?>
          <div class="dropdown-divider"/></div>
          <a class="dropdown-item" onclick="visible_nouveaugroupe_petitecran()">Créer un groupe</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controleur/charger_profil.php">Mon profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Controleur/charger_inactifs.php">Mes inactifs</a>
      </li>
    </ul>
  <ul class="navbar-nav ml-lg-auto">
    <li class="nav-item">
      <a class="nav-link" href="../Controleur/deconnexion.php">Deconnexion</a>
    </li>
  </ul>
  </div>
</nav>

<script type="text/javascript">
  function invisible_nouveaugroupe_petitecran(){
    document.getElementById("nouveau-groupe-petitecran").className = "nouveau-groupe invisible";
  }
  function visible_nouveaugroupe_petitecran(){
    document.getElementById("nouveau-groupe-petitecran").className = "nouveau-groupe visible";
  }
</script>

<div id="nouveau-groupe-petitecran" class="nouveau-groupe invisible">
  <h2>Nouveau Groupe</h2>
  <form class="" action="../Controleur/nouveau_groupe.php" method="post">
    <input type="text" name="titre" value="" placeholder="Titre"><br/>
    <input type="submit" value="Ajouter">
  </form>
    <button type="button" name="annuler" onclick="invisible_nouveaugroupe_petitecran()">Annuler</button>
</div>
