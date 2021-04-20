<!DOCTYPE html>
<html>

    <head>
      
        <meta charset="utf-8">
        <title>Accueil</title>
    
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
    
    </head>
    </style>
    <body>
    
        <!-- header -->
    
       
        <header class="header">
            <div class="container">
                <a href="index.php" class="logo"><img src="Images/logo.png" width=40px alt="logo du site" style="margin-top: 7px;"/></a> 
                <p class="logo" style="margin-left: 50px; margin-top: 0;">CVVEN calendrier</p>

                
                
                <nav class="menu">
                    <a href="index.php"> Accueil </a>
                    <a href="Voyage.php"> Voyages </a>
                    <a href="MesReserv.php"> Reservations </a>
                    <a href="admin.php"> Admin </a>
                    <a href="calendrier.php"> Calendrier</a>
                </nav>
                </div>
            
                </header>

                <?php
               
require 'test.php';
require 'Reserv.php';
$pdo = get_pdo();
$reserv = new Reserv($pdo);
if (!isset($_GET['id'])) {
    header('location: /404.php');
}
try {
    $reserva = $reserv->find($_GET['id']);
} catch (\Exception $e) {
    e404();
}


?>
<br>
<br>

<br>

<h1> <?= h($reserva->getName());?></h1>

<ul>
<li> Date: <?= $reserva->getStart()->format('d/m/y'); ?> </li>
<li> Heure de démarrage: <?= $reserva->getStart()->format('H:i'); ?> </li>
<li> Heure de fin: <?= $reserva->getEnd()->format('H:i'); ?> </li>
<li> 
    Description:<br>
    <?= h($reserva->getDescription()); ?> 
 </li>



</ul>
