<!DOCTYPE html>

<html lang="fr">

  <head>

    <title> Blog </title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css"/>

    <meta charset = "UTF-8">

     <?php
     session_start();
     include 'connexion.php';
      ?>

  </head>

<body>

  <nav class="menu">  <!-- Menu du haut -->

    <ul>
          <li> <a href="accueil.php">Retourner à l'accueil</a> </li>
          <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>');
            echo('<li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>');
            echo("<li class='itemMenu'> <a href='javascript:if(confirm(\"Vous allez être déconnecté\")){   location.href=\"deconnexion.php\" }' > Se déconnecter </a> </li>");

          }

          ?>

    </ul>
  </nav>

  <br />

<?php

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();  // Requete qui recupere les données de l'article
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet,sujet.idredacteur
                                FROM sujet,redacteur
                                WHERE sujet.idredacteur = redacteur.idredacteur
                                AND idsujet =" . $_GET['idsujet'] )
                                ;

  echo("<div class='articleBlog'>");  //Conteneur de l'article

   while ( ($colonne = $statement->fetch()) ){   //tant qu'il y a des résultats

     echo('<div class="article">');

       echo('<h2 class="titreArticle">'   . $colonne['titresujet'] . '</h2>');

       echo('<div class="contenuArticle">'   . nl2br($colonne['textesujet']) . '</div>');

        echo('<br />');

        echo('<div class  = "infosArticle">');

          echo('<div class="lienReponses">');
             if(isSet($_SESSION['pseudo']))
              echo(" <a href='reponse.php?idsujet="  . $colonne['idsujet'] . "'> Répondre à l'article </a>"); //Si l'utilisateur est connecté, il peut répondre
          echo('</div>');

          setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
          echo('<div class="dateArticle"> Ecrit par <b>' . $colonne['prenom'] . " ".  $colonne['nom'] . "</b>, le  <b>" .   strftime("%A %d %B %G",strtotime($colonne['datesujet']))   . '  </b>  </div>');

        echo('</div>');

     echo('<br /> </div>');

  }

  echo("</div>");

   echo("<br /> <br /> <br />");

    $statement = $objetPDO->query("SELECT textereponse,daterep,nom,prenom
                                  FROM reponse,redacteur
                                  WHERE  reponse.idredacteur = redacteur.idredacteur
                                  AND reponse.idsujet =" . $_GET['idsujet']
                                );  //Requete qui récupère les données des réponses

    echo("<div id='espaceCommentaire'>");

     while ( ($colonne = $statement->fetch()) ){  // tant qu'il y a des résultats

      echo("<div class='reponse'>");

        echo("<div class='titreReponse'>");
          echo( "Par <b>" . $colonne['prenom'] ." " . $colonne['nom'] .",</b> le <b>" . $colonne['daterep'] ."</b>");
        echo("</div>");

        echo("<div class='contenuReponse'>");
            echo(nl2br($colonne['textereponse']));
        echo('</div>');

      echo("</div>");

  }

    echo("</div>");

    unset($objetPDO);
 ?>

 </body>

</html>
