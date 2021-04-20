<?php
require('Connexion.php');
session_start();

require('others/ifconnected.php');

$notif = "SELECT * FROM `RESERVATION` WHERE `Situation` = 1 ";

$resultnotif = mysqli_query($conn,$notif) or die(mysql_error());

$query2 = "SELECT `id_Reservation`,`Num_Type_Hebergement`,`date-reserv`,`Date_Arrivee`,`Date_Depart`,`Nb_Personnes`,`Pension`,`Menage`,`Situation`,`id_Client` FROM `RESERVATION` WHERE `Situation` = 1 "; 

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
                <a href="index.html" class="logo"><img src="Images/logo.png" width=40px alt="logo du site" style="margin-top: 7px;"/></a> 
                <p class="logo" style="margin-left: 50px; margin-top: 0;">CVVEN <span style="font-size: 50%;">(Admin)</span></p>

                
                
                <nav class="menu">
                    <a href="listeuser.php"> liste des utilisateurs </a>
                    <a href="listereserv.php"> liste des reservations </a>
                    <a href="reserv.php"> Demandes de reservation <span style="font-size: 70%;">(<?php echo mysqli_num_rows($resultnotif) ?>)</span></a>
 
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
            <div id="div_1" style="width: 1700px; height: 600px; font-size: 80%;">

                <br>

                <h1 style="color: #ffffff; text-align: left; margin-left: 2%;">Demandes de reservation</h1>

                <br>

                <?php 

                if (mysqli_num_rows($result2) == 0)
                {
                    echo '
                    
                    <div style="height: 200px;"></div>

                    <h2><i class="far fa-times-circle"></i> Aucune demande reservation</h2>
                    
                    ';
                }
                else
                {

                echo '<table style="width: 90% ;font-size: 120%;">

                    <tr style="height: 50px;">
                        <th></th>
                        
                        <th>Reservation</th>

                        <th>Date reservation </th>

                        <th>Du </th>

                        <th>Au</th>

                        <th>Nb Semaines</th>

                        <th>Nb Personnes</th>

                        <th>Pension</th>

                        <th>Service Ménage</th>

                        <th>situation</th>

                        <th>Validation</th>
                    </tr>';

                    

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

                        <td><h3 id="h3_01">';

                        $id_util = $rows2['id_Client'];

                        $query4 = "SELECT `NomClient` FROM `CLIENT` WHERE `id_Client` = '$id_util'";

                        $result4 = mysqli_query($conn,$query4) or die(mysql_error());

                        $rows4 = mysqli_num_rows($result4);

                        if($rows4==1)
                        {
                            while($rows4 = $result4->fetch_assoc()) 
                            {
                                echo $rows4["NomClient"];
                            }
                        }
                        
                        echo'</h3></td>';
                             
                        echo '<td>'. $rows2["date-reserv"].'</td>

                        

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

                        <td>
                            <div id="div_13">
                            <input id="input_04" type="button" onclick="window.location.href = \'validation.php?id='.$rows2["id_Reservation"].'\'" value="Accepter">
                            <input id="input_04" type="button" onclick="window.location.href = \'refus.php?id='.$rows2["id_Reservation"].'\'" value="Refuser">
                            </div>
                        </td>
                    </tr>';

                    $cpt = $cpt + 1;

                    }

                    echo '
                

                    <tr>

                        <td colspan="11">
    
                            <hr style="color: #ffffff;">
    
                        </td>
                    <tr>
                    
                </table>';

                } ?>
                

            <div>
        <center>
    
        
</body>
</html>