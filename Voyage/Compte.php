<?php
require('Connexion.php');
session_start();

if (isset($_POST['Nom_utilisateur']))
{
    $login = $_POST['Nom_utilisateur'];
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $mot_passe = md5($_POST['Mot_Passe']);
    $Cmot_passe = md5($_POST['CMot_Passe']);
    $mail = $_POST['Mail'];

    if ($mot_passe != $Cmot_passe)
    {
        $ErrMotdepasse = "Mots de Passe Differents";
    }
    else
    {
        $query = "SELECT `Login` FROM CLIENT WHERE `Login` = '$login'"; 
        
        $result = mysqli_query($conn,$query) or die(mysql_error());

        $rows = mysqli_num_rows($result);

        if($rows==1)
        {
            $ErrMotdepasse = "Nom d'utilisateur deja utilisé";
        }
        else
        {
            $query = "INSERT INTO `CLIENT`(`NomClient`, `PrenomClient`, `Login`, `Motdepasse`, `Mail`,`admin`) VALUES ('$nom', '$prenom', '$login', '$mot_passe', '$mail', 0)";

            mysqli_query($conn,$query) or die(mysql_error());

            header('Location: SeConnecter.php');

        }
    }
}


?>


<!DOCTYPE html>
<html>

    <head>
      
        <meta charset="utf-8">
        <title>Accueil</title>
    
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
    
    </head>
    
    <body>
    
        <!-- header -->
    
       
        <header class="header">
            <div class="container">
                <a href="index.php" class="logo"><img src="Images/logo.png" width=40px alt="logo du site" style="margin-top: 7px;"/></a> 
                <p class="logo" style="margin-left: 50px; margin-top: 0;">CVEN</p>

                
                
                <nav class="menu">
                    <a href="index.php"> Accueil </a>
                    <a href="Voyage.php"> Voyages </a>
                    <a href="MesReserv.php"> Reservations </a>
                    
                    <?php
                    session_start();

                    if (isset($_SESSION["login"]))
                    {
                        echo "<a style='margin-right: 40px;'>";
                        echo ($_SESSION["login"]);
                        echo "</a>";
                        echo "<a href='logout.php'><img src='Images/deconnexion.png' width=25px style='margin-top: 10px; position: absolute;'/></a>";
                    }
                    else
                    {
                        echo "<a href='SeConnecter.php'> Authentification </a>";
                    }
                    ?>
 
                </nav>

            </div>
        </header>
        <!-- fin header -->

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    
        <center>
            <div id="div_1" style="height: 900px;">

                <br>

                <h1 style="color: #ffffff;">Inscription</h1>

                <form method="POST" action="Compte.php">

                    <br>
                    <br>

                    <label for="Nom_utilisateur">Nom D'utilisateur</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px; margin-right: 10px; margin-left: 10px;"  type="text" name="Nom_utilisateur" placeholder="Nom"  required><span style="color: red; position: absolute;" ><p>  *</p></span><br>

                    <br>
                    <br>

                    <label for="Nom">Nom</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px; margin-right: 10px; margin-left: 10px;"  type="text" name="Nom" placeholder="Dupont"  required><span style="color: red; position: absolute;" ><p>  *</p></span><br>

                    <br>
                    <br>

                    <label for="Prenom">Prénom</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px; margin-right: 10px; margin-left: 10px;"  type="text" name="Prenom" placeholder="Steeve"  required><span style="color: red; position: absolute;" ><p>  *</p></span><br>


                    <br>
                    <br>
                    <hr style="color: #ffffff; width: 350px;">
                    <br>

                    <label for="Mot_Passe">Mot de Passe</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px; margin-right: 10px; margin-left: 10px;"  type="password" name="Mot_Passe" placeholder="*******" required><span style="color: red; position: absolute;" ><p>  *</p></span><br>

                    <br>
                    <br>

                    <label for="CMot_Passe">Confirmer Mot de Passe</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px; margin-right: 10px; margin-left: 10px;"  type="password" name="CMot_Passe" placeholder="*******" required><span style="color: red; position: absolute;" ><p>  *</p></span><br>

                    <br>
                    <br>
                    <hr style="color: #ffffff; width: 350px;">
                    <br>

                    <label for="Mail">Adresse Mail</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px;  margin-right: 10px; margin-left: 10px;"  type="email" name="Mail" placeholder="JeanDupont@Gmail.com" required><span style="color: red; position: absolute;" ><p>  *</p></span><br>

                    <br>
                    <br>

                    <span style="color: red;"><?php echo $ErrMotdepasse; ?></span>

                    <br>
                    <br>
                    <br>

                    <input style="border: none; width: 130px; height: 24px; background-color: #ffffff; color: rgb(0, 0, 0); border-radius: 6px;" type="submit" value="Insription">

                </form>

            <div>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        <center>
    
        
</body>
</html>
