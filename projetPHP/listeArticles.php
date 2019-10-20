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
          <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>

                <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>
                <li class="itemMenu"> <a href="deconnexion.php" class="itemMenu"> Se déconnecter </a> </li>');
          }

          ?>

    </ul>

  </nav>


  <h1 class="titre"> Liste des articles publiés sur le site : </h1>

  <div id='articlesPresentation'>

  <?php

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom FROM sujet,redacteur WHERE sujet.idredacteur = redacteur.idredacteur ORDER BY  datesujet DESC");


  while ($colonne = $statement->fetch()){

    echo(

       "<div class='article'>" .

          "<h2 class='titreArticle'>"   . $colonne['titresujet'] . "</h2>"    .
          "<div class='contenuArticle'>"   . $colonne['textesujet'] . "</div> <br />
           <div class  = 'dateArticle'> Ecrit par : " . $colonne['prenom'] . " ".  $colonne['nom'] . ", le :  <b>" .  $colonne['datesujet'] . " </b> </div>

      </div>.


       <br />"

    );

  }
  ?>

</div>

</body>

</html>
