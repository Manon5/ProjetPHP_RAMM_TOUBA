<!DOCTYPE html>

<html lang="fr">

  <head>

    <?php
    session_start();

    include 'connexion.php';
     ?>
    <meta charset = "UTF-8">
    <title> Blog pour le projet de PHP </title>
    <link rel = "stylesheet"
     type = "text/css"
     href = "style.css"/>

  </head>

<body>

    <nav class="menu">

      <ul>
            <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

            <?php

            if(isSet($_SESSION['pseudo'])){

              echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>

                  <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>'
                );
            }

            ?>

      </ul>

    </nav>





<?php



  if(!isSet($_SESSION['pseudo'])){

    echo("<h1 class='titre'> Bienvenue sur le blog du projet PHP ! </h1>");

      echo('<div id="menuAccueil">');
      echo('<form action="creationCompte.php">');
          echo('<input type="submit" value="Créer un compte rédacteur">');
      echo('</form>');

      echo('<form action="authentification.php">');
        echo('<input type="submit" value="S\'authentifier">');
      echo('</form>');

  }

  else{

      echo("<h1 class='titre'> Bienvenue sur le blog du projet PHP, " . $_SESSION['pseudo'] ." ! </h1>");

        echo('<div id="menuAccueil">');
    echo("<form action='deconnexion.php'>");
      echo("<input type='submit' value='Se déconnecter'>");
    echo("</form>");

  }

echo("</div>");

?>

<h1 class="titre"> Voici les derniers articles disponibles sur le blog : </h1>


  <?php




  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet FROM sujet,redacteur WHERE sujet.idredacteur = redacteur.idredacteur ORDER BY  idsujet DESC");

  echo("<div id='articlesPresentation'>");

  $nbArticles=0;

   while ( ($colonne = $statement->fetch()) && ($nbArticles < 4)  ){

    ++$nbArticles;

    if (strlen($colonne['textesujet']) > 400){
      $contenu = $colonne['textesujet'] ;
      $contenu = substr($contenu,0,399) . "...";
    }

    else
      $contenu = $colonne['textesujet'];

      echo('<div class="article">');

        echo('<h2 class="titreArticle">'   . $colonne['titresujet'] . '</h2>');
        echo('<div class="contenuArticle">'   . $contenu . '</div>');
        echo(' <br />');

      echo('<div class  = "infosArticle">');
          echo('<div class="lienReponses">');
            echo(" <a href='blog.php?idsujet="  . $colonne['idsujet'] . "'> Lire l'article  </a>");
          echo('</div>');

          echo('<div class="dateArticle"> Ecrit par : ' . $colonne['prenom'] . " ".  $colonne['nom'] . ", le :  <b>" .  $colonne['datesujet'] . '  </b>  </div>');

      echo('</div>');

      echo('<br />');

      echo('</div>');
  }

  echo("</div>");

  unset($objetPDO);
   ?>

</body>

</html>
