<!DOCTYPE html>

<html lang="fr">

<head>



  <title> Liste des articles </title>

  <link rel = "stylesheet"
        type = "text/css"
        href = "style.css"/>
  <meta charset = "UTF-8">

  <?php
    include('connexion.php');
    session_start();
  ?>

</head>

<body>

  <nav class="menu">  <!-- Menu du haut-->

    <ul>
          <li> <a href="accueil.php">Retourner à l'accueil</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>');
            echo('<li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>');
            echo('<li class="itemMenu"> <a href="deconnexion.php" class="itemMenu"> Se déconnecter </a> </li>');

          }

          ?>

    </ul>
  </nav>

  <?php

    if(isSet($_SESSION['pseudo']))
      echo('<div id="pseudo"><b> Vous êtes connecté, ' . $_SESSION['pseudo'] ." </b>!");
   ?>

  <h1 class="titre"> Liste des articles publiés sur le site : </h1>

  <div id='articlesPresentation'>

  <?php

  $maConnexion = new Connexion();  //Création de la connexion
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet
                                 FROM sujet,redacteur
                                 WHERE sujet.idredacteur = redacteur.idredacteur
                                 ORDER BY  datesujet DESC");

  while ($colonne = $statement->fetch()){  //tant qu'il y a des résultas

        if (strlen($colonne['textesujet']) > 400){
          $contenu = $colonne['textesujet'] ;
          $contenu = substr($contenu,0,399) . "...";    //On réduit les articles à 400 caractères pour ne pas surchager la page
        }

        else
          $contenu = $colonne['textesujet'];

       echo('<div class="article">');

         echo('<h2 class="titreArticle">'   . $colonne['titresujet'] . '</h2>');

          echo('<div class="contenuArticle">'   . $contenu . '</div>');

            echo(' <br />');

            echo('<div class  = "infosArticle">');
            echo('<div class="lienReponses">');
            echo(" <a href='blog.php?idsujet="  . $colonne['idsujet'] . "'> Lire l'article </a>");

          echo('</div>');

          setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1'); //Changer la timezone pour formater les dates en français
          echo('<div class="dateArticle"> Ecrit par <b>' . $colonne['prenom'] . " ".  $colonne['nom'] . "</b>, le <b>" . strftime("%A %d %B %G",strtotime($colonne['datesujet']))  . '  </b>  </div>');

         echo('</div>');

         echo('<br />');

        echo('</div>');

  }

  ?>

  </div>

 </body>

</html>
