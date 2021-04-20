<?php
  require('Connexion.php');
  // Initialiser la session
  session_start();
  
  require('others/ifconnected.php');

  $notif = "SELECT * FROM `RESERVATION` WHERE `Situation` = 1 ";

  $resultnotif = mysqli_query($conn,$notif) or die(mysql_error());

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

        <div style="width: 80%; background: radial-gradient(rgb(48, 48, 48,0.6)40%,rgb(167, 29, 29,0),rgb(167, 29, 29,0)100%); height: 600px; border-radius: 60px;">

        <br>
        <br>
        <br>

        <table>
            <tr>

                <td id="titre_1">

                </td>

                <td>

                    <img src="Images/logo.png" width="500px">

                </td>

                <td width="500px">

                    <h1 id="titre_2" style="font-size: 800%;">CVVEN</h1>

                </td>

            </tr>

        </table>

        </div>

        </center>

        <div style="height: 300px;">

        </div>

        <footer id="footer">

            <center> 
            <br>
            <br>

            <hr style="color: #ffffff; width: 80%;">
            <br>
            Site CVVEN
            <br> 
            <br>
            Réalisé par Damien DENOYELLES , Brandon LOKETO, Teo DARCHY, Rémi FABRE
            <br>
            <br>
            <br>
            <br>
            </center> 

        </footer>
    
        
</body>
</html>
