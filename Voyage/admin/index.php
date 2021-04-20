<?php
  session_destroy();

  require('Connexion.php');
  // Initialiser la session
  session_start();

  $_SESSION["login"] = null;  
  
  if (isset($_POST['Nom_utilisateur']))
    {
    $login = $_POST['Nom_utilisateur'];

    if (isset($_POST['Mot_Passe']))
    {
        $mdp = md5($_POST['Mot_Passe']);

        $query = "SELECT `Login`,`Motdepasse`,`id_Client` FROM CLIENT WHERE `Login` = '$login' AND `Motdepasse` = '$mdp' AND `admin`= 1"; 
        
        $result = mysqli_query($conn,$query) or die(mysql_error());

        $rows = mysqli_num_rows($result);

        if($rows==1)
        {
            while($row = $result->fetch_assoc()) 
            {
                $_SESSION["id_Client"] = $row["id_Client"];
            }
            
            $_SESSION["login"] = $login;
            header("Location: menu.php");
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
        <title>Accueil</title>
    
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
    
    </head>
    
    <body>
    
        <center>

            <div style="height: 200px;"></div>

            <div id="div_11" style="height: 450px;">

                <h1>CVVEN (admin)</h1>

                <form method="POST" action="index.php">

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

                    <input style="border: none; width: 130px; height: 24px; background-color: #ffffff; color: rgb(0, 0, 0); border-radius: 6px;" type="submit" value="Authentification">

                </form>

            </div>

        </center>
       
        
    </body>
</html>
