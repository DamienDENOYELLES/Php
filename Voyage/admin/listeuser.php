<?php
require('Connexion.php');
session_start();

if (empty($_SESSION["login"]))

{
header('Location: index.php');
}

$notif = "SELECT * FROM `RESERVATION` WHERE `Situation` = 1 ";

$resultnotif = mysqli_query($conn,$notif) or die(mysql_error());

$query2 = "SELECT `NomClient`, `PrenomClient`, `Mail` FROM `CLIENT`"; 

$result2 = mysqli_query($conn,$query2) or die(mysql_error());

$rows2 = mysqli_num_rows($result2);

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
                <a href="index.html" class="logo"><img src="Images/logo.png" width=40px alt="logo du site" style="margin-top: 7px;"/></a> 
                <p class="logo" style="margin-left: 50px; margin-top: 0;">CVVEN <span style="font-size: 50%;">(Admin)</span></p>

                
                
                <nav class="menu">
                    <a href="listeuser.php"> liste des utilisateurs </a>
                    <a href="listereserv.php"> liste des reservations </a>
                    <a href="reserv.php"> Demandes de reservation <span style="font-size: 70%;">(<?php echo mysqli_num_rows($resultnotif) ?>)</span> </a>
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
            <div id="div_1" style="width: 1700px;  font-size: 80%;">

                <br>

                <h1 style="color: #ffffff; text-align: left; margin-left: 2%;">Comptes Utilisateurs</h1>

                <br>

                <table style="width: 90% ;font-size: 120%;">

                    <tr style="height: 50px;">
                        <th></th>
                        
                        <th>Nom</th>

                        <th>Prénom</th>

                        <th>Mail</th>

                    </tr>

                    <?php

                    $cpt = 1;

                    while($rows2 = $result2->fetch_assoc())  
                    {

                    echo '

                    <tr>

                        <td colspan="10">
    
                            <hr style="color: #ffffff;">
    
                        </td>
                    <tr>

                    <tr style="height: 50px; text-align: center;">
                        <td>'. $cpt .'</td>

                        <td>'.$rows2["NomClient"].'</td>

                        <td>'.$rows2["PrenomClient"].'</td>

                        <td><a style="color: white; text-decoration: underline;" href="mailto:'.$rows2["Mail"].'">'.$rows2["Mail"].'</a></td>
                       
                    </tr>';

                    $cpt = $cpt + 1;

                    }

                    ?>
                </table>
                

            </div>
        <center>

        <div style="height : 100px;">
        </div>
        
    
        
</body>
</html>