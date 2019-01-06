<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mes inactifs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <?php include'Composant/meta.php';?>
</head>
<body>
    <?php include'Composant/class.php'; ?>
    <?php include'Composant/navbar_connect.php';?>

<section class="padding-page">

        <h1>Liste de mes comptes</h1>
        <?php
            if(!isset($_SESSION['sesInactifs'])){
            echo "error sesInactifs";}
            $sesInactifs = $_SESSION['sesInactifs'];
            foreach($sesInactifs as $membre){
                $id = $membre->getID();
                echo $membre->getNom()." ".$membre->getPrenom()." ".$membre->getID() ; ?>

                <button onclick="visible_gerer_inactif()">Sa liste</button>

                <div id="modifier-membre-inactif" class="modifier-membre-inactif invisible">
                    <h2><?php echo $membre->getNom()." ".$membre->getPrenom()." ".$membre->getID() ; ?></h2>

                    <?php
                    $numeroCadeau = 0 ;
  //ERREUR ICI ----------------------------------------------
                    $sesCadeaux = $_SESSION['sesCadeaux']; // permet d'avoir la liste des cadeau du créateur des inactifs

                   //normalement il faut faire cette ligne en dessous
                    //$sesCadeaux = $membre->getSesCadeaux();  // commente la ligne au dessus et decommente celle-ci et sa part en couille xD

  //FIN ERREUR -----------------------------------------------
                    foreach($sesCadeaux as $cadeau){
                        $numeroCadeau +=1;
                        $id = $cadeau->getID();
                        echo $numeroCadeau.") ".$cadeau->getNom()." : ".$cadeau->getDesc()." est numero : ".$cadeau->getID(); ?>

                        <form action="..\controleur\supprimer_cadeau.php" method="get">
                            <?php echo "<input type = 'hidden' name='idCadeauSupprime' value='$id'>";?>
                            <input type="submit" value="Supprimer"/>
                        </form>
                        <?php
                    }
                        ?>

                    <form class="" action="../Controleur/ajouter_membre.php" method="post">
                        <input type="text" name="email" value="" placeholder="e-mail"><br/>
                        <input class="invisible" id="-input" type="text" name="-input" value="<?php echo $_SESSION['idLastGroupe'];?>">
                        <input type="submit" value="Ajouter">
                    </form>


                    <button type="button" name="annuler" onclick="invisible_gerer_inactif()">Annuler</button>
                </div>

                <form action="..\controleur\supprimer_inactif.php" method="get">
                    <?php echo "<input type = 'hidden' name='idUserInactif' value='$id'>";?>
                    <input type="submit" value="Supprimer"/>
                </form>
        <?php    }
        ?>

        <h1>Créer un nouveau compte</h1>
        <form action="..\Controleur\ajouter_inactif.php" method="post">
            <label for ="nom"> Nom : </label>
            <input type="text" name="nom" value="" />
            <br>
            <label for ="prenom"> Prenom : </label>
            <input type="text" name="prenom" value=""/>
            <br>
            <fieldset>
                <legend>Ajouter dans vos groupes séléctionnés</legend>

                <?php
                $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
                foreach($sesGroupesMembre as $groupe){
                    echo "<input type='checkbox' name='groupe[]' value='".$groupe->getIdGroupe()."'>";
                    echo "<label for='groupe'>".$groupe->getNom()."</label><br>" ;
                }
                ?>
            </fieldset>
            <input type="submit" value="Créer"/>
        </form>

    </section>

    <script type="text/javascript">
        function visible_gerer_inactif() {
            document.getElementById("modifier-membre-inactif").className = "modifier-membre-inactif visible";
        }
        function invisible_gerer_inactif(){
            document.getElementById("modifier-membre-inactif").className = "modifier-membre-inactif invisible";
        }
    </script>


    <?php include'Composant/footer.php';?>
    <?php include'Composant/body_script.php';?>
</body>
</html>
