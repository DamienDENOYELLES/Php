<!DOCTYPE html>
<html>

    <head>
      
        <meta charset="utf-8">
        <title>Accueil</title>
    
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
    
    </head>
    <style>

    .calendrier{
        width: 95%;
        height: 400px;
        border-collapse: collapse;
    }

    .calendrier td{
        padding:10px;
        border: 1px solid #CCC;
        vertical-align: top;
        width: 14.29%;
        height: 20px;
    }

    .calendrier.calendrier__table--5weeks td{
    height: 17;
    }

    .calendrier_weekday{
        font-weight: bold;
        color: #000;
        font-size: 1.2em;
    }

    .calendrier__othermonth .calendrier_day{
    opacity: 0.8;
    }

    .calendrier_day{
        font-size: 1.3em;;
    }

    .button{
        background-color: rgb(22, 22, 22);
        border-radius: 8px;
        color: white;
        padding: 5px;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        
    }
  .calendar {
    position: relative;
}

.calendrier__button {
  display: block;
    width: 55px;
    height: 55px;
    line-height: 55px;
    text-align: center;
    color: #FFF;
    font-size:30px;
    background-color:rgb(22, 22, 22) ;
    border-radius: 50%;

    box-shadow: 0 6px 10px 0 #0000001a,0 1px 18px 0 #0000001a,0 3px 5px -1px #0003;
    position: absolute;
    bottom: 30px;
    right: 30px;
    text-decoration: none;
    transition: transform 0.3s;
}
.calendrier__button:hover{
  transform: scale(1.2);
  text-decoration: none;
  color: #FFF;
}
    
    </style>    
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
        <?php
            require('Connexion.php');
            require 'test.php';
            require 'Month.php';
            require 'Reserv.php';
            $id = $_GET['id'];
            $pdo = get_pdo();
            $reserv = new Reserv($pdo);
            $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
            $start = $month->getStartingDay();
            $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
            $weeks = $month->getWeeks();
            $end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . ' days');
            $reserv = $reserv->getReservBetweenByDay($start, $end);
            $y = 0;

        ?>
        <!-- fin header -->

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <center>
    
        <div id="div_1" style="width: 1600px; height: 700px;">

        <br>

        <h1 style="color: #ffffff; text-align: left; margin-left: 2%;">Calendrier</h1>

        <br>

        <div class="calendar">

  <div class="d-flex flex-row align-items-center justify-content-between" style="margin-bottom: 20px;">
    <h1><?= $month->toString(); ?></h1>
    <div>
      <a href="Calendrier.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>&id=<?php echo $id; ?>" class="button">&lt;</a>
      <a href="Calendrier.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>&id=<?php echo $id; ?>" class="button">&gt;</a>
    </div>
  </div>


  <table class="calendrier calendar__table--<?= $weeks; ?>weeks">
  <?php for ($i = 0; $i < $weeks; $i++): ?>
  <tr>
    <?php
    foreach($month->days as $k => $day):
        $date = (clone $start)->modify("+" . ($k + $i * 7) . " days");
        $reservJour = $reserv[$date->format('Y-m-d')] ?? [];

    ?>
    <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
      <?php if ($i === 0): ?>
      <div class="calendar_weekday"><?= $day;?></div>
      <?php endif; ?>
      <div class="calendar_day"><?= $date->format('d'); ?></div>
      <div class="calendrier__reserva">
        <?php
          $dt = $date->format('Y-m-d');
          $sql = "SELECT `Num_Hebergement`,`Date_Arrivee`,`Date_Depart` FROM RESERVATION WHERE `Num_Hebergement` = $id AND (`Date_Arrivee` = '$dt' OR `Date_Depart` = '$dt')";
          $result = mysqli_query($conn,$sql) or die(mysql_error());
          $rows = mysqli_num_rows($result);


          if ($rows == 1 && $y == 1)
          {
            $y = 0;
          }

          elseif ($rows == 1 && $y == 0)
          {
            $y = 1;
          }

          if ($y == 1)
          {
            echo '<span style="color: red;"> indisponible</span>';
          }

          if ($y == 0)
          {
            echo '<span style="color: green;"> disponible</span>';
          }



        ?>

        
        
      </div>
    </td>
    <?php endforeach; ?>
  </tr>
  <?php endfor; ?>
</table>

        </div>

        <div style="height: 300px;"></div>

        </center>
          
        
</body>
</html>