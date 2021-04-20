<?php
require('Connexion.php');
session_start();

if (empty($_SESSION["login"]))
{
    header('Location: Noconnect.php');
}

$id = $_GET['id'];

$query = "DELETE FROM `RESERVATION` WHERE `RESERVATION`.`id_Reservation` = $id"; 

$result = mysqli_query($conn,$query) or die(mysql_error());

header('Location: MesReserv.php');

?>