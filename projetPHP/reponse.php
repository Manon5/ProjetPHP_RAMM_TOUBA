<!DOCTYPE html>

<html lang="fr">

<head>

  <title> Rédaction d'une réponse </title>

  <link rel = "stylesheet"
        type = "text/css"
        href = "style.css"/>
  <meta charset = "UTF-8">

     <?php
       session_start();
       include('connexion.php');
      ?>

 </head>

<body>

  <h1 class="titre">Rédaction d'une réponse : </h1>

  <form action = <?php echo ('reponse.php?idsujet=' . $_GET['idsujet'])?> method="post">

    <div>
      <textarea name="textereponse" rows="8" cols="40" maxlength="999"> </textarea>
    </div>

    <div id="submitRep">
      <input type='submit' value='Validez votre réponse'>
    </div>

  </form>

<!-- Partie traitement des données -->

<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $maConnexion = new Connexion();
    $objetPDO = $maConnexion->creer_Connexion();

    $statement = $objetPDO->prepare("INSERT INTO reponse(idsujet,idredacteur,daterep,textereponse)
                                     VALUES(?,?,NOW(),?)"); //On insère la réponse dans la bdd

    $statement->bindValue(1,$_GET['idsujet']);
    $statement->bindValue(2,$_SESSION['idredacteur']);
    $statement->bindValue(3,$_POST['textereponse']);

    $statement->execute();

    header("Location: blog.php?idsujet=" . $_GET['idsujet']);  // On renvoie l'utilisateur sur la page du sujet concerné

  }

?>

 </body>

</html>
