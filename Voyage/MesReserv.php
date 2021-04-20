<?php
require('Connexion.php');
session_start();

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

$query2 = "SELECT `id_Reservation`,`Num_Type_Hebergement`,`Date_Arrivee`,`Date_Depart`,`date-reserv`,`Nb_Personnes`,`Pension`,`Menage`,`Situation` FROM `RESERVATION` WHERE `id_Client` = '$id_client' ORDER BY `date-reserv` DESC"; 

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
            <div id="div_1" style="width: 1700px; font-size: 80%;">

                <br>

                <h1 style="color: #ffffff; text-align: left; margin-left: 2%;">Mes Réservations</h1>

                <br>

                <table style="width: 90% ;font-size: 120%;">

                    <tr style="height: 50px;">
                        <th></th>
                        
                        <th>Reservation</th>

                        <th>Date reservation</th>

                        <th>Du </th>

                        <th>Au</th>

                        <th>Nb Semaines</th>

                        <th>Nb Personnes</th>

                        <th>Pension</th>

                        <th>Service Ménage</th>

                        <th>situation</th>

                        <th> </th>
                    </tr>

                    <?php

$cpt = 1;

                    while($rows2 = $result2->fetch_assoc())  
                    {

                    echo '

                    <tr>

                        <td colspan="11">
    
                            <hr style="color: #ffffff;">
    
                        </td>
                    <tr>

                    <tr style="height: 50px; text-align: center;">
                        <td>'. $cpt .'</td>

                        <td><u><h3 id="h3_01"><a style="color: #ffffff;" href="Details.php?id=1">';

                        $num = $rows2['Num_Type_Hebergement'];

                        $query4 = "SELECT `Type_Hebergement` FROM `TYPE_HEBERGEMENT` WHERE `Num_Type_Hebergement` = '$num'";

                        $result4 = mysqli_query($conn,$query4) or die(mysql_error());

                        $rows4 = mysqli_num_rows($result4);

                        if($rows4==1)
                        {
                            while($rows4 = $result4->fetch_assoc()) 
                            {
                                echo $rows4["Type_Hebergement"];
                            }
                        }       

                        echo '<td>'. $rows2["date-reserv"]. '</td>';

                        echo'</a></h3></u></td>

                        <td>'; $datetime1 = $rows2["Date_Arrivee"]; echo $datetime1; echo'</td>

                        <td>'; $datetime2 = $rows2["Date_Depart"]; echo $datetime2; echo'</td>

                        <td>';

                        $date1 = date_create($datetime1);
                        $date2 = date_create($datetime2);
                        $interval = date_diff($date1, $date2);
                        echo ($interval->format('%a')/7);

                        
                        echo'</td>

                        <td>'. $rows2["Nb_Personnes"]. '</td>

                        <td>'. $rows2["Pension"]. '</td>

                        <td>'. $rows2["Menage"]. '</td>

                        <td>';

                        $situation = $rows2["Situation"];

                        if ($situation == 1){
                            echo '<img src=\'Images/orange.png\' style="height: 15px;"> En attente';    
                        }

                        elseif ($situation == 2) {
                            echo '<img src=\'Images/verte.png\' style="height: 15px;"> Accepté';    
                        }

                        elseif ($situation == 3) {
                            echo '<img src=\'Images/rouge.png\' style="height: 15px;"> Refusé';
                        }
                        
                        else {
                            echo '?';
                        }
                        
                        
                        echo '</td>

                        <td>';

                        if ($situation == 1)
                        {
                            echo '<input id="input_04" type="button" onclick="window.location.href = \'confirmeAnnulation.php?id='.$rows2["id_Reservation"].'\'" value="Annuler">';    
                        }
                        else
                        {
                            echo'<i class="fas fa-check"></i>';
                        }


                        echo '</td>
                    </tr>';

                    $cpt = $cpt + 1;

                    }

                    ?>
                    
                </table>
                

            <div>
        <center>
    
        
</body>
</html>