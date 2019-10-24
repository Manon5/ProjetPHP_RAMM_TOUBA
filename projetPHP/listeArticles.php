<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset = "UTF-8">
  <?php
    include('connexion.php');
    session_start();
   ?>

  <title> Liste des articles publics </title>
  <link rel = "stylesheet"
   type = "text/css"
   href = "styleAccueilListeArticles.css"/>

</head>

<body>

  <nav class="menu">

    <ul>
          <li> <a href="accueil.php">Retourner à l'accueil</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>

                <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>');
                  echo("<li class='itemMenu'> <a href='javascript:if(confirm(\"Vous allez être déconnecté\")){   location.href=\"deconnexion.php\" }
                ' > Se déconnecter </a> </li>");
          }

          ?>

    </ul>

  </nav>


  <h1 class="titre"> Liste des articles publiés sur le site : </h1>

  <div id='articlesPresentation'>

  <?php

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet FROM sujet,redacteur WHERE sujet.idredacteur = redacteur.idredacteur ORDER BY  datesujet DESC");


  while ($colonne = $statement->fetch()){


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


        unset($objetPDO);

  }
  ?>

</div>

</body>

</html>
