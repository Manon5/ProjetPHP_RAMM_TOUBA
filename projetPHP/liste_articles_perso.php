<!DOCTYPE html>

<html lang="fr">

  <head>

    <title> Mes articles </title>

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
            <li> <a href="accueil.php">Revenir à l'accueil</a> </li>
            <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

            <?php

            if(isSet($_SESSION['pseudo'])){

              echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>');
              echo('<li> <a href="deconnexion.php">Se déconnecter</a> </li>');

            }

            ?>

      </ul>
    </nav>

    <?php

    echo("<h1 class=titre>" . $_SESSION['pseudo'] . ", voici la liste des articles que vous avez écrit ! </h1>");

    $maConnexion = new Connexion();  //Requete qui récupère les informations sur les sujets et le redacteur
    $objetPDO = $maConnexion->creer_Connexion();
    $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, idsujet
                                   FROM sujet,redacteur
                                   WHERE redacteur.idredacteur = sujet.idredacteur
                                   AND sujet.idredacteur =" . $_SESSION['idredacteur']  .
                                  " ORDER BY  datesujet DESC");

    echo("<div id='articlesPresentation'>");

     while ( ($colonne = $statement->fetch())  ){

        echo('<div class="article">');

          echo('<h2 class="titreArticle">'   . $colonne['titresujet'] . '</h2>');

            echo('<div class="contenuArticle">'   . $colonne['textesujet'] . '</div>');

              echo('<div class  = "infosArticle">');

                echo('<div class="lienReponses">');
                  echo(" <a href='blog.php?idsujet="  . $colonne['idsujet'] . "'> Voir les réponses  </a>");
                echo('</div>');

              echo('</div>');

              echo('<br />');

           echo('</div>');
    }

      echo("</div>");

     ?>

  </body>

</html>
