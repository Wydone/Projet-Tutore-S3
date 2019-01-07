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

<section class="padding-page center">

<section class="listeCompte">
        <h1>Liste de mes comptes</h1>
        <?php
            if(!isset($_SESSION['sesInactifs'])){
            echo "error sesInactifs";}
            $sesInactifs = $_SESSION['sesInactifs'];
            foreach($sesInactifs as $membre){
                echo "<div class='compte'>"; 
                $id = $membre->getID();
                echo $membre->getNom()." ".$membre->getPrenom()." ".$membre->getID() ;


                ?>

                <?php echo '<button onclick="visible_gerer_inactif('.$membre->getID().')" class="btn btn-danger">Sa liste</button>';?>

                  <?php echo '<div id="modifier-membre-inactif'.$membre->getID().'" class="modifier-membre-inactif invisible">';?>
                    <h2><?php echo $membre->getNom()." ".$membre->getPrenom()." ".$membre->getID() ; ?></h2>
                    <?php
                    $numeroCadeau = 0 ;
                    $id = $membre->getID();
                    $sesCadeaux = $membre->getSesCadeauxInactif($id);
                    foreach($sesCadeaux as $cadeau){
                        $numeroCadeau +=1;
                        $id = $cadeau->getID();
                        echo $numeroCadeau.") ".$cadeau->getNom()." : ".$cadeau->getDesc()." est numero : ".$cadeau->getID(); ?>

                        <form action="..\controleur\supprimer_cadeau.php" method="get">
                            <?php echo "<input type = 'hidden' name='idCadeauSupprime' value='$id'>";?>
                            <input type="submit" value="Supprimer"/>
                        </form>
                        <?php
                    }$id = $membre->getID();    
                        ?>
                   
                
                    
                    <form action="..\Controleur\ajouter_cadeau_inactif.php" method="post" enctype="multipart/form-data" >
                        <p>Nouveau cadeau : </p>
                        <input type="text" name="nom" value="" placeholder= "nom" />           
                        <textarea type="textarea" name="desc" value="" placeholder= "description"></textarea>
                        <input type="file" name="image" value="" />
                        <input type="text" name="lien" value="" placeholder= "lien"/>
                        <?php echo "<input type = 'hidden' name='idUserInactif' value='$id'>";?>
                        <input type="submit" value="Ajouter"/>
                    </form>

                    <?php echo '<button type="button" name="annuler" onclick="invisible_gerer_inactif('.$membre->getID().')">Annuler</button>';?>

                </div>


                <?php echo '<button onclick="visible_gerer_inactif_groupe('.$membre->getID().')" class="btn btn-danger">Ses groupes</button>';?>

                <?php echo '<div id="modifier-membre-inactif-groupe'.$membre->getID().'" class="modifier-membre-inactif-groupe invisible">';?>
                    
                <form action="..\Controleur\modifier_groupe_inactif.php" method="post">
            
                    <fieldset>
                    <legend>Modifer ses groupes : </legend>

                    <?php
                    $sesGroupesMembre=$_SESSION['sesGroupesMembre'];
                    foreach($sesGroupesMembre as $groupe){
                        if(!$membre->verifGroupe($groupe->getIdGroupe(), $membre->getID())){
                        echo "<input type='checkbox' name='groupe[]' value='".$groupe->getIdGroupe()."' >";
                        }else echo "<input type='checkbox' name='groupe[]' value='".$groupe->getIdGroupe()."' checked>";
                        
                        echo "<label for='groupe'>".$groupe->getNom()."</label><br>" ;
                    }
                    ?>
                    </fieldset>
                    <?php echo "<input type = 'hidden' name='idUserInactif' value='$id'>";?>
                <input type="submit" value="Modifier"/>
             </form>
                   
                    <?php echo '<button type="button" name="annuler" onclick="invisible_gerer_inactif_groupe('.$membre->getID().')">Annuler</button>';?>

                </div>



                
                <form action="..\controleur\supprimer_inactif.php" method="get" class= "btnSupprimer">
                    
                    <?php echo "<input type = 'hidden' name='idUserInactif' value='$id'>";?>
                    <input type="submit" value="Supprimer" class="btn btn-secondary"/>
                </form>
                </div>
                <br/><br/>
                
        <?php    }
        ?>
</section>
         
<section class="creerCompte">
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
            <input type="submit" value="Créer" class= "btn-form"/>
        </form>

    </section>
            </section>

    <script type="text/javascript">
        function visible_gerer_inactif(id) {
            document.getElementById("modifier-membre-inactif"+id).className = "modifier-membre-inactif visible";
        }
        function invisible_gerer_inactif(id){
            document.getElementById("modifier-membre-inactif"+id).className = "modifier-membre-inactif invisible";
        }

        function visible_gerer_inactif_groupe(id) {
            document.getElementById("modifier-membre-inactif-groupe"+id).className = "modifier-membre-inactif-groupe visible";
        }
        function invisible_gerer_inactif_groupe(id){
            document.getElementById("modifier-membre-inactif-groupe"+id).className = "modifier-membre-inactif-groupe invisible";
        }
    </script>


    <?php include'Composant/footer.php';?>
    <?php include'Composant/body_script.php';?>
</body>
</html>
