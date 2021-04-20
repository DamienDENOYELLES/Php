<?php
require('Connexion.php');
session_start();

require('others/ifconnected.php');

$id = $_GET['id'];

$query = "UPDATE `RESERVATION` SET `Situation` = '3' WHERE `RESERVATION`.`id_Reservation` = $id"; 

$result = mysqli_query($conn,$query) or die(mysql_error());

header('Location: reserv.php');

?>