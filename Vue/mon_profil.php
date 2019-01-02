<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mon profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <?php include'Composant/meta.php';?>
</head>
<body>
    <?php include'Composant/class.php'; ?>
    <?php include'Composant/navbar_connect.php';?>

<section class="padding-page">


    <h1>Mes infos</h1>
    <?php
        if(!isset($_SESSION['nom'])){
            echo "error";
        }else {
            echo $_SESSION['email']."<br>".$_SESSION['nom']."<br>".$_SESSION['prenom'];
        }
        if(isset($mdpModifie)){
            echo "<br>mot de passe modifié <br>"; //gérer cette option
        }
    ?>
            <form action="..\Controleur\modifier_mdp.php" method="post">
                <label for ="mdp"> Nouveau mot de passe : </label>
                <input type="password" name="mdp" value="" />
                 <br>
                <label for ="verifmdp"> Confirmer mot de passe :  </label>
                <input type="password" name="verfimdp" value=""/>
                <br>

                <input type="submit" value="Modifier"/>
            </form>
            

    <h1>Mes souhaits</h1>
    <?php
        $numeroCadeau = 0 ;
        $sesCadeaux=$_SESSION['sesCadeaux'];
        foreach($sesCadeaux as $cadeau){
            $numeroCadeau +=1;
            $id = $cadeau->getID(); 
            echo $numeroCadeau.") ".$cadeau->getNom()." : ".$cadeau->getDesc()." est numero : ".$cadeau->getID(); ?>
          
            <form action="..\controleur\supprimer_cadeau.php" method="get">
                <?php echo "<input type = 'hidden' name='idCadeauSupprime' value='$id'>";?>
                <input type="submit" value="Supprimer"/>
            </form>

       <?php }
       
    ?>
            <h2>Ajouter un cadeau à ma liste </h2>
            <form action="..\Controleur\ajouter_cadeau.php" method="post" enctype="multipart/form-data" >
                <label for ="nom"> Nom : </label>
                <input type="text" name="nom" value="" />
                <br>
                <label for ="desc"> Description :  </label>
                <textarea type="textarea" name="desc" value=""></textarea>
                <br>
                <label for ="image"> Image : </label>
                <input type="file" name="image" value="" />
                <br>
                <label for ="lien"> lien : </label>
                <input type="text" name="lien" value="" />
                <br>
                <input type="submit" value="Ajouter"/>
            </form>
    <h1>Groupes que j'administre</h1>
    <?php
        if(!isset($_SESSION['sesGroupesAdmin'])){
        echo "error sesGroupesAdmin";}
        $sesGroupesAdmin=$_SESSION['sesGroupesAdmin'];
        foreach($sesGroupesAdmin as $groupe){
            echo "groupe : ".$groupe->getNom()."<br>" ;
        }
    ?>


</section>


      <?php include'Composant/footer.php';?>
      <?php include'Composant/body_script.php';?>
</body>
</html>