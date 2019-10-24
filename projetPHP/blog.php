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
     href = "styleBlog.css"/>

  </head>

<body>

  <nav class="menu">

    <ul>
          <li> <a href="accueil.php">Retourner à l'accueil</a> </li>
          <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>

                <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>
                <li class="itemMenu"> <a href="deconnexion.php" class="itemMenu"> Se déconnecter </a> </li>'
              );
          }



          ?>

    </ul>

  </nav>

  <br />
<?php


  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet,sujet.idredacteur
                                FROM sujet,redacteur
                                WHERE sujet.idredacteur = redacteur.idredacteur
                                AND idsujet =" . $_GET['idsujet'] )
                                ;

  echo("<div id='articlesPresentation'>");

   while ( ($colonne = $statement->fetch()) ){
     echo('<div class="article">');

       echo('<h2 class="titreArticle">'   . $colonne['titresujet'] . '</h2>');
       echo('<div class="contenuArticle">'   . $colonne['textesujet'] . '</div>');
       echo(' <br />');

     echo('<div class  = "infosArticle">');
         echo('<div class="lienReponses">');
             if(isSet($_SESSION['pseudo']))
              echo(" <a href='reponse.php?idsujet="  . $colonne['idsujet'] . "'> Répondre à l'article </a>");
         echo('</div>');

         echo('<div class="dateArticle"> Ecrit par : ' . $colonne['prenom'] . " ".  $colonne['nom'] . ", le :  <b>" .  $colonne['datesujet'] . '  </b>  </div>');

     echo('</div>');

     echo('<br />');

     echo('</div>');
  }

  echo("</div>");

   echo("<br /> <br /> <br />");



    $statement = $objetPDO->query("SELECT textereponse,daterep,nom,prenom
                                  FROM reponse,redacteur
                                  WHERE  reponse.idredacteur = redacteur.idredacteur
                                  AND reponse.idsujet =" . $_GET['idsujet'])

                                  ;

    echo("<div id='espaceCommentaire'>");

     while ( ($colonne = $statement->fetch()) ){

       echo("<div class='reponse'>");

       echo("<div class='titreReponse'>");
        echo("Ecrit par : " . $colonne['nom'] ." " .  $colonne['prenom']);
       echo("</div>");
          echo("<div class='contenuReponse'>");
            echo($colonne['textereponse']);
          echo('</div>');

      echo("</div>");

  }



echo("</div>");

 ?>

</body>
</html>
