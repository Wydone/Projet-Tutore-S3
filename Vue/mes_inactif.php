<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mes inactifs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

    <?php include'Composant/meta.php';?>
</head>
<body>

    <?php include'Composant/navbar_connect.php';?>

    <h1>Liste de mes comptes</h1>

    <h1>Créer un nouveau compte</h1>
    <form action="..\Controleur\ajouter_inactif.php" method="post">
                <label for ="nom"> Nom : </label>
                <input type="text" name="nom" value="" />
                 <br>
                <label for ="prenom"> Prenom : </label>
                <input type="text" name="prenom" value=""/>
                <br>

                <input type="submit" value="Modifier"/>
            </form>

    <?php include'Composant/body_script.php';?>

    <?php include'Composant/footer.php';?>
    <?php include'Composant/body_script.php';?>
</body>
</html>
