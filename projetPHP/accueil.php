
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

<div id="articles">
    <form action="listeArticles.php">
      <input type="submit" value="Voir les articles publics">
    </form>
</div>

<h1 class="titreAccueil"> Voici les derniers articles disponibles sur le blog : </h1>


  <?php

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet FROM sujet ORDER BY  datesujet DESC");


   while ($colonne = $statement->fetch()){

    echo(

       "<div class='titreArticle'>"   . $colonne['titresujet'] . "</div>"
      ."<div class='article'>"   . $colonne['textesujet'] . "</div>
       <br/ >"
    );

   }


   ?>

</body>

</html>
