<?php
require('Connexion.php');
session_start();

if (empty($_SESSION["login"]))
{
    header('Location: Noconnect.php');
}

if (empty($_SESSION["login"]))
{
    header('Location: Noconnect.php');
}

$login = $_SESSION["login"];

$query1 = "SELECT `id_Client` FROM `CLIENT` WHERE `Login` = '$login'";

$result1 = mysqli_query($conn,$query1) or die(mysql_error());

$rows1 = mysqli_num_rows($result1);

if($rows1==1)
{
    while($rows1 = $result1->fetch_assoc()) 
    {
        $id_client = $rows1["id_Client"];
    }
}

$id = $_GET['id'];


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
            <div id="div_1" style="width: 700px; font-size: 80%;">

                <br>

                <h1 style="color: #ffffff; text-align: center;">Confirmer ?</h1>

                <br>

                <div class="flex div_13">
                
                <div><input id="input_05" type="button" onclick="window.location.href = 'MesReserv.php'" value="Annuler"></div>
                <div><input id="input_05" type="button" onclick="window.location.href = 'annulation.php?id=<?php echo $id; ?>'" value="Confirmer"></div>
                
                </div>
                

            <div>
        <center>
    
        
</body>
</html>