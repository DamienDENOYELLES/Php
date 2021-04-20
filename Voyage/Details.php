<?php
require('Connexion.php');
session_start();

if (empty($_GET['id']))
{
    $_GET['id'] = 0;    
}

$query = "SELECT `Num_Type_Hebergement`,`Type_Hebergement`,`Description`,`Nb_Chambres`,`Tarif`,`Note`,`Lien_Photo` FROM `TYPE_HEBERGEMENT` WHERE `Num_Type_Hebergement` =".$_GET['id']; 

$query2 ="SELECT `Num_Hebergement`,`Nom_Logement`,`Description`,`Nb_Pers_Max` FROM `HEBERGEMENT` WHERE `Num_Type_Hebergement` = ".$_GET['id'];

$result = mysqli_query($conn,$query) or die(mysql_error());

$rows = mysqli_num_rows($result);

$result2 = mysqli_query($conn,$query2) or die(mysql_error());

$rows2 = mysqli_num_rows($result2);

?>

<!DOCTYPE html>
<html>

    <head>
      
        <meta charset="utf-8">
        <title>Accueil</title>
    
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
        <script src="https://kit.fontawesome.com/3780874350.js" crossorigin="anonymous"></script>
    
    </head>
    
    <body>
    
        <!-- header -->
    
       
        <header class="header">
            <div class="container">
                <a href="index.php" class="logo"><img src="Images/logo.png" width=40px alt="logo du site" style="margin-top: 7px;"/></a> 
                <p class="logo" style="margin-left: 50px; margin-top: 0;">CVVEN</p>

                
                
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

        <div id="div_3">

        <?php

        while($row = $result->fetch_assoc()) 
        {
            echo '

            <h1 style="color: #ffffff; text-align: left;">Détails et reservations - '. $row["Type_Hebergement"]. '</h1>

                <hr style="color: #ffffff; width: 100%;">

                <br>

                <table>

                    <tr>
                        <td rowspan="4" style="width: 40%; padding-right: 2%">

                            <img src="Images/'.$row["Lien_Photo"].'" style="width: 100%; border-radius: 5px;"/>

                        </td>

                        <td>
                            Type Hebergement : '. $row["Description"]. '
                        </td>

                    </tr>

                    <tr>
                        <td>
                            Nb Chambres : '. $row["Nb_Chambres"]. '
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Tarif :  '. $row["Tarif"]. '€ / Semaine
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Note : <span style="font-size: 130%;">';

                            $x = 1;

                            while ($x <= ($row["Note"]))
                            {
                                echo "⭐";

                                $x++;
                            }
                            
                            echo ' </span>
                        </td>
                    </tr>

                </table>
                ';
        }

        ?> 
        <br>

        <hr style="color: #ffffff; width: 84%; text-align: left; position: absolute;">

        <br>

        <?php

        if(mysqli_num_rows($result2) > 0)
        {
            echo '<h2 style="text-align: left;">Logements disponibles</h2>';
        }
        else
        {
            echo '<h2 style="text-align: left;">Aucun Logement disponible</h2>';
        }

        ?>

        
        
        <br>

        <!-- -->

        <?php 

        while($row2 = $result2->fetch_assoc()) 
        {
            echo '

            <table style="font-size: 120%; width: 50%; text-align: left; margin-right: 50%;">

            <tr style="height: 50px;">
            
                <th colspan="2"><i style="margin-right: 10px;" class="fas fa-home fa-lg"></i>'. $row2["Nom_Logement"].'</th>

            </tr>

            <tr style="height: 50px;">

                <td colspan="2">'. $row2["Description"].'</td>

            
            </tr>

            <tr style="height: 50px;">

            <td><input id="input_02" type="button" onclick="window.location.href = \'Calendrier.php?id='.$row2["Num_Hebergement"].'\'" value="Voir les disponibilités"></td>
            <td style="width: 75%;">
            <input id="input_01" type="button" onclick="window.location.href = \'Reservation.php?id='.$_GET['id'].'&Num_Hebergement='.$row2["Num_Hebergement"].'\'" value="Reservation"></td>
            
            </tr>


        </table>

        <br>

        <hr style="color: #ffffff; width: 40%; text-align: left; position: absolute;">

        <br>
            
            ';
        }

        ?>


    </div>

    </center>



    <div style="height: 150px;">
    </div>
        
</body>
</html>
