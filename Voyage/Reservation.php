<?php
session_start();
require('Connexion.php');

if (empty($_SESSION["login"]))
{
    header('Location: Noconnect.php');
}

if (isset($_POST['date_debut']))
{

    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $nb_pers = $_POST['nb_pers'];
    $type_pension = $_POST['type_pension'];
    $menage = $_POST['menage'];
    $id = $_GET["id"];
    $Num_Hebergement = $_GET["Num_Hebergement"];
    $id_client = $_SESSION["id_Client"];
    $date = date("Y-m-d"); 

    $query = "SELECT `Tarif` FROM `TYPE_HEBERGEMENT` WHERE `Num_Type_Hebergement` = $id";
    
    $result = mysqli_query($conn,$query) or die(mysql_error());

    $rows = mysqli_num_rows($result);

    while($row = $result->fetch_assoc()) 
    {
        $tarif = $row["Tarif"];
    }
    

    $query2 = "INSERT INTO `RESERVATION`(`Date_Arrivee`, `Date_Depart`, `date-reserv`, `Pension`, `Menage`, `Nb_Personnes`, `Tarif_Sejour`, `Etat_Reservation`, `id_Client`, `Num_Hebergement`, `Num_Type_Hebergement`,`Situation`) VALUES ('".$date_debut."', '".$date_fin."', '".$date."',' ".$type_pension."', '".$menage."', ".$nb_pers.", ".$tarif.", 1, ".$id_client.", ".$Num_Hebergement.", ".$id.", 1)"; 
    
    mysqli_query($conn,$query2) or die(mysql_error());

    header("Location: index.php");

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
        <div id="div_1" style="width: 800px; font-size: 80%;">

        <?php $lien = "Reservation.php?id=".$_GET["id"]."&Num_Hebergement=".$_GET["Num_Hebergement"]; ?>

        <form method="POST" action="<?php echo $lien; ?>">

            <br>

            <h1 style="color: #ffffff;">Reserver</h1>

            <table>
                <tr style="height: 100px;">
                    <td style="padding-right: 30px;">
                        <label for="date_debut">Reservation du :</label><br>
                        <input style="border: none; width: 220px; height: 27px; margin-top: 7px; padding-left: 5px; border-radius: 5px;" min="2020-12-05" step="7" type="date" name="date_debut"  required><br>
                    </td>

                    <td style="padding-left: 30px;">
                        <label for="date_fin">Au :</label><br>
                        <input style="border: none; width: 220px; height: 27px; margin-top: 7px; padding-left: 5px; border-radius: 5px;"min="2020-12-05" step="7" type="date" name="date_fin" required><br>
                    </td>
                    
                </tr>

                <tr style="height: 30px;">

                    <td colspan="2">

                        <hr style="color: #ffffff;">

                    </td>

                </tr>

                <tr style="height: 100px;">

                    <td style="padding-right: 30px;">
                        <label for="nb_pers">Nombre de personnes :</label><br>
                        <input style="border: none; width: 220px; height: 27px; margin-top: 7px; padding-left: 5px; border-radius: 5px;" type="number" name="nb_pers" value="1" min="1" max="10">
                    </td>

                    <td style="padding-left: 30px;">
                        <label for="type_pension">Pension :</label><br>
                        <select style="border: none; width: 220px; height: 27px; margin-top: 7px; padding-left: 5px; border-radius: 5px; -webkit-appearance: none; -moz-appearance: none; appearance: none;" name="type_pension">
                            <option  value="Demi_Pension">Demi Pension</option>
                            <option value="Pension_complète">Pension complète</option>
                        </select>
                    </td>

                </tr>


            </table>

            <p>service Ménage :</p>

            <div style="text-align: left; width: 80px;">

            <input type="radio" name="menage" value="avec" required>
            <label style="border: none;" for="Avec">avec</label><br>

            <input type="radio" name="menage" value="sans" required>
            <label style="border: none;" for="Sans">sans</label><br>

            </div>

            <br>
            <br>

            <input style="border: none; width: 120px; height: 24px; background-color: #ffffff; color: rgb(0, 0, 0); border-radius: 7px;" type="submit" value="Reserver">

        </form>

        </div>
        </center>
</body>
</html>