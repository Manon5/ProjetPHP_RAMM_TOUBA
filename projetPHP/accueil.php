
<html>

  <head>

    <?php
    include('connexion.php');
     ?>
    <meta charset = "UTF-8">
    <title> Blog pour le projet de PHP </title>
    <link rel = "stylesheet"
     type = "text/css"
     href = "styleAccueil.css"/>

  </head>

<body>

    <h1 class="titreAccueil"> Bienvenue sur le blog du projet PHP ! </h1>

<div id="menuAccueil">

    <form action="creationCompte.php">
      <input type="submit" value="Créer un compte rédacteur">
    </form>

    <form action="authentification.php">
      <input type="submit" value="S'authentifier">
    </form>

</div>



<h1 class="titreAccueil"> Voici les derniers articles disponibles sur le blog : </h1>


  <?php


  session_start();

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom FROM sujet,redacteur WHERE sujet.idredacteur = redacteur.idredacteur ORDER BY  datesujet DESC");

  echo("<div id='articlesPresentation'>");

  $nbArticles=0;

   while ( ($colonne = $statement->fetch()) && ($nbArticles < 2)  ){

    ++$nbArticles;

    echo(

       "<div class='article'>" .

          "<h2 class='titreArticle'>"   . $colonne['titresujet'] . "</h2>"    .
          "<div class='contenuArticle'>"   . $colonne['textesujet'] . "</div> <br />
           <div class  = 'dateArticle'> Ecrit par : " . $colonne['prenom'] . " ".  $colonne['nom'] . ", le :  <b>" .  $colonne['datesujet'] . " </b> </div>
      </div>.


       <br/ >"

    );

  }

  echo("</div>");

   ?>

   <div id="articles">
       <form action="listeArticles.php">
         <input type="submit" value="Voir tous les articles disponibles">
       </form>
   </div>

</body>

</html>
