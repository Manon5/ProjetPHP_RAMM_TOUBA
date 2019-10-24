
<html>

<head>

  <?php
  session_start();
    include('connexion.php');
   ?>



  <title> Rédaction d'une réponse </title>
  <link rel = "stylesheet"
   type = "text/css"
   href = "styleAccueilListeArticles.css"/>
  <head>

<body>

  <nav class="menu">

    <ul>
          <li> <a href="accueil.php">Revenir à l'accueil</a> </li>
          <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>
            <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>');                  echo("<li class='itemMenu'> <a href='javascript:if(confirm(\"Vous allez être déconnecté\")){   location.href=\"deconnexion.php\" }
            ' > Se déconnecter </a> </li>");
          }

          ?>

    </ul>

  </nav>

  <h1>Rédaction d'une réponse : </h1>

  <form action =<?php echo ('reponse.php?idsujet=' . $_GET['idsujet'])?> method="post">

    <div>
      <label for ="textereponse">Votre réponse : </label>
      <p><textarea name="textereponse" rows="8" cols="45"> </textarea></p>
    </div>

    <div>
      <input type='submit' value='Validez votre réponse'> </input>
    </div>

  </form>

<!-- Partie traitement des données -->

<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();

      $statement = $objetPDO->prepare("INSERT INTO reponse(idsujet,idredacteur,daterep,textereponse) VALUES(?,?,NOW(),?)");

      $statement->bindValue(1,$_GET['idsujet']);
      $statement->bindValue(2,$_SESSION['idredacteur']);
      $statement->bindValue(3,$_POST['textereponse']);

      $statement->execute();

      header("Location: blog.php?idsujet=" . $_GET['idsujet']);


}

 unset($objetPDO);


    ?>

</body>

</html>
