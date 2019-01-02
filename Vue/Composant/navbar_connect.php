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

      <li class="nav-item active visible-grand-ecran">
        <a class="nav-link" href="../Vue/mes_groupes.php">Mes groupes <span class="sr-only">(current)</span></a>
      </li>

      <!--petit ecran-->

      <li class="nav-item active visible-petit-ecran">
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

              echo '<a class="dropdown-item" href="#">groupe Membre : '.$groupe->getNom()."</a>" ;
          }

          ?>
          <div class="dropdown-divider"/></div>
          <a class="dropdown-item" href="#">Créer un groupe</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Vue/mon_profil.php">Mon profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Mes inactifs</a>
      </li>
    </ul>
  <ul class="navbar-nav ml-lg-auto">
    <li class="nav-item">
      <a class="nav-link" href="#">Deconnexion</a>
    </li>
  </ul>
  </div>
</nav>
