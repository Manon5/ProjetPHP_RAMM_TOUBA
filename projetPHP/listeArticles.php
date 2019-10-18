
<html>

<head>
  <meta charset = "UTF-8">
  <?php
    include('connexion.php');
   ?>

  <title> Liste des articles publics </title>

</head>

<body>

  <h1> Liste des articles publiés sur le site : </h1>
  <table>

  <?php

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet FROM sujet ORDER BY  datesujet DESC");


   while ($colonne = $statement->fetch()){

     echo("<tr> <td>" . $colonne['titresujet'] ."</td> <td>" . $colonne['textesujet'] ."</td> </tr>");

   }


   ?>

  </table>

</body>

</html>
