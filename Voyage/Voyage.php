<?php
require('Connexion.php');
session_start();

$query = "SELECT `Num_Type_Hebergement`,`Type_Hebergement`,`Description`,`Nb_Chambres`,`Tarif`,`Note`,`Lien_Photo` FROM `TYPE_HEBERGEMENT` "; 
        
$result = mysqli_query($conn,$query) or die(mysql_error());

$rows = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>

    <head>
      
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Accueil</title>
    
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
    
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

        <center>
        <h1 style="color: #ffffff; font-size: 300%;">Voyages</h1>

        <div class="flex-container">

        <?php
        
        while($row = $result->fetch_assoc()) 
        {

            echo'
            <div id="div_4" class="div-flex">

                <div id="div_5">

                    <h2 style="color: #ffffff; text-align: left;"><u><a href="Details.php?id='.$row["Num_Type_Hebergement"].'" style="color: #ffffff;">'. $row["Type_Hebergement"]. '</a></u></h2>

                    <hr style="color: #ffffff; width: 100%;">

                    <div id="div_6">

                        <div id="div_7"><img src="Images/'. $row["Lien_Photo"]. '" style="width: 100%; border-radius: 5px;"/></div>
                        <div id="div_8">
                            <div id="div_9">Type Hebergement : '. $row["Description"]. '</div>
                            <div id="div_9">Nb Chambres : '. $row["Nb_Chambres"]. '</div>
                            <div id="div_9">Tarif : '. $row["Tarif"]. '€ / Semaine</div>
                            <div id="div_9">Note : <span style="font-size: 130%;">';$x = 1;while ($x <= ($row["Note"])){echo "⭐";$x++;} echo'</div>
                        </div>

                    </div>
                </div>
                <div id="div_10">

                    <input id="input_01" type="button" onclick="window.location.href = \'Details.php?id='.$row["Num_Type_Hebergement"].'\'" value="Détails et reservations">

                </div>

            </div>';

        } ?>

        </div>

        </center>
            

        
    
        
</body>
</html>