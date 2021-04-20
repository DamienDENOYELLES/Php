<?php
require('Connexion.php');
session_start();

if (isset($_POST['Nom_utilisateur']))
{
    $login = $_POST['Nom_utilisateur'];

    if (isset($_POST['Mot_Passe']))
    {
        $mdp = md5($_POST['Mot_Passe']);

        $query = "SELECT `Login`,`Motdepasse`,`id_Client` FROM CLIENT WHERE `Login` = '$login' AND `Motdepasse` = '$mdp'"; 
        
        $result = mysqli_query($conn,$query) or die(mysql_error());

        $rows = mysqli_num_rows($result);

        if($rows==1)
        {
            while($row = $result->fetch_assoc()) 
            {
                $_SESSION["id_Client"] = $row["id_Client"];
            }
            
            $_SESSION["login"] = $login;
            header("Location: index.php");
        }
        else
        {
            $incorrect = "Nom d'utilisateur ou Mot de passe incorrect !";
        }

    }
}

?>
<!DOCTYPE html>
<html>

    <head>
      
        <meta charset="utf-8">
        <title>SeConnecter</title>
    
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
            <div id="div_1">

                <br>

                <h1 style="color: #ffffff;">Authentification</h1>

                <form method="POST" action="SeConnecter.php">

                    <br>
                    <br>
                    <br>

                    <label for="Nom_utilisateur">Nom D'utilisateur</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px;"  type="text" name="Nom_utilisateur" placeholder="Nom"  required><br>

                    <br>
                    <br>
                    <hr style="color: #ffffff; width: 350px;">
                    <br>

                    <label for="Mot_Passe">Mot de Passe</label><br>
                    <input style="border: none; width: 250px; height: 30px; margin-top: 6px; padding-left: 5px;"  type="password" name="Mot_Passe" placeholder="*******" required><br>

                    <br>
                    <br>
                    
                    <span style="color: red;"> <?php echo $incorrect; ?></span>

                    <br>
                    <br>

                    <input style="border: none; width: 130px; height: 24px; background-color: #ffffff; color: rgb(0, 0, 0); border-radius: 6px;" type="submit" value="Se connecter">

                </form>

                <br>

                <p></p>Pas encore chez Nous ? <u><a href="Compte.php" style="color: #fff;">S'inscrire</a></u></p>


                </div>
                
        <center>
    
        
</body>
</html>
