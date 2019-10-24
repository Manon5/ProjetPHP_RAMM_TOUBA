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
     href = "styleAccueilListeArticles.css"/>

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

    <h1 class="titre"> Bienvenue sur le blog du projet PHP ! </h1>





<?php

  if(!isSet($_SESSION['pseudo'])){

    echo('<div id="menuAccueil">');
      echo('<form action="creationCompte.php">');
          echo('<input type="submit" value="Créer un compte rédacteur">');
      echo('</form>');

      echo('<form action="authentification.php">');
        echo('<input type="submit" value="S\'authentifier">');
      echo('</form>');

  }

  else{

    echo('<div id="menuAccueil">');
    echo("<form action='deconnexion.php'>");
      echo("<input type='submit' value='Se déconnecter'>");
    echo("</form>");

  }

echo("</div>");
echo("<br />");
?>

<h1 class="titre"> Voici les derniers articles disponibles sur le blog : </h1>


  <?php




  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet FROM sujet,redacteur WHERE sujet.idredacteur = redacteur.idredacteur ORDER BY  datesujet DESC");

  echo("<div id='articlesPresentation'>");

  $nbArticles=0;

   while ( ($colonne = $statement->fetch()) && ($nbArticles < 4)  ){

    ++$nbArticles;


      echo('<div class="article">');

        echo('<h2 class="titreArticle">'   . $colonne['titresujet'] . '</h2>');
        echo('<div class="contenuArticle">'   . $colonne['textesujet'] . '</div>');
        echo(' <br />');

      echo('<div class  = "infosArticle">');
          echo('<div class="lienReponses">');
            echo(" <a href='blog.php?idsujet="  . $colonne['idsujet'] . "'> Voir les réponses  </a>");
          echo('</div>');

          echo('<div class="dateArticle"> Ecrit par : ' . $colonne['prenom'] . " ".  $colonne['nom'] . ", le :  <b>" .  $colonne['datesujet'] . '  </b>  </div>');

      echo('</div>');

      echo('<br />');

      echo('</div>');
  }

  echo("</div>");

   ?>

</body>

</html>
