<!DOCTYPE html>
<html>

    <head>
      
        <meta charset="utf-8">
        <title>Accueil</title>
        <link rel="stylesheet" type="text/css" href="Styles/style.css">
    
    </head>
    <body>
  <style>
      .bouton_ajout{
        position: relative;
        bottom: 60px;
        left: 95%; 
        background-color: black;
  border-radius: 12px;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
    
      }


  </style>

   
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


<center><h1>Ajouter une réservation</h1></center>
<?php
require 'test.php';
?>
<div class="add_user ">


<form  action="" method="post" class="form">
   <div class="add_titre" style="position:relative; left:30%;top:50px;">
    <div class="form-group">
        <label for="name">Titre </label>
        <input id="name" type="texte" class="form-control" name="name">
    </div>
</div>

<div class="add_date"style="position:relative; left:60%;top:25px;">
    <div class="form-group">
        <label for="date">Date </label>
        <input id="date" type="date" class="form-control" name="name">
    </div>
</div>

<div class="add_start" style="position:relative; left:30%;top:95px;">
    <div class="form-group">
        <label for="start">Démarrage </label>
        <input id="start" type="time" class="form-control" name="start" placeholder="HH:MM">
    </div>
</div>

<div class="add_left "style="position:relative; left:60%;top:75px;">
    <div class="form-group">
        <label for="end">Fin </label>
        <input id="end" type="time" class="form-control" name="end" placeholder="HH:MM">
    </div>
</div>

<p style="position:relative; left:30%;top:110px;">
       Service de Ménage<br />
       <input type="radio" name="choix" value="oui" id="oui" /> <label for="oui">oui</label><br />
       <input type="radio" name="choix" value="non" id="non" /> <label for="non">non</label><br />
</p>

<div style="position:relative;right:65%; top:170px;">
<button class="bouton_ajout"> Ajouter la réservation</button>


</div>
</div>
</form>
</div>
