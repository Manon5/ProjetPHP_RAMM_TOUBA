<!DOCTYPE html>

<html lang="fr">

  <head>

    <title> Blog pour le projet de PHP </title>

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

    <nav class="menu">    <!-- Menu du haut qui est adapté en fonction de si la personne est connectée ou non -->
      <ul>
            <li> <a href="listeArticles.php">Voir tous les articles </a> </li>

            <?php

            if(isSet($_SESSION['pseudo'])){

              echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>');
              echo(' <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>');

            }

            echo(' </ul>
                  </nav>');

            if(!isSet($_SESSION['pseudo'])){

              echo("<h1 class='titre'> Bienvenue sur le blog du projet PHP ! </h1>");

              echo('<div id="menuAccueil">');

                echo('<form action="creationCompte.php">');
                  echo('<input type="submit" value="Créer un compte rédacteur">');
                echo('</form>');

                echo('<form action="authentification.php">');
                  echo('<input type="submit" value="S\'authentifier">');
                echo('</form>');

              echo("</div>");

  }

            else{

                echo("<h1 class='titre'> Bienvenue sur le blog du projet PHP, " . $_SESSION['pseudo'] ." ! </h1>");

                echo('<div id="menuAccueil">');
                  echo("<form action='deconnexion.php'>");
                    echo("<input type='submit' value='Se déconnecter'>");
                  echo("</form>");
                echo("</div>");

            }

?>

<h1 class="titre"> Voici les derniers articles disponibles sur le blog : </h1>

  <?php

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();
  $statement = $objetPDO->query("SELECT titresujet, textesujet, datesujet, nom, prenom, idsujet
                                 FROM sujet,redacteur
                                 WHERE sujet.idredacteur = redacteur.idredacteur
                                 ORDER BY  idsujet DESC");   //Requete qui récupère les infos des articles et du rédacteur concerné

  echo("<div id='articlesPresentation'>");  //Div qui contient les 4 articles de présentation sur la page d'accueil

  $nbArticles=0;

   while ( ($colonne = $statement->fetch()) && ($nbArticles < 4)  ){  //Tant qu'on a des résultats et qu'on a publié moins de 4 articles (histoire de ne pas surchager l'accueil)

    ++$nbArticles;

    if (strlen($colonne['textesujet']) > 400){    //Si le contenu de l'article est trop grand, on le coupe pour inciter à aller voir l'article en entier

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
              echo(" <a href='blog.php?idsujet="  . $colonne['idsujet'] . "'> Lire l'article  </a>");  //Lien qui affiche l'article et ses réponses en simulant la méthode GET (paramètres dans l'URL)
            echo('</div>');

           setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1'); //Changer la timezone pour formater les dates en français
           echo('<div class="dateArticle"> Ecrit par <b>' . $colonne['prenom'] . " ".  $colonne['nom'] . "</b>, le <b>" . strftime("%A %d %B %G",strtotime($colonne['datesujet']))  . '  </b>  </div>');

         echo('</div>');

      echo('<br />');

      echo('</div>');
  }

  echo("</div>");

  unset($objetPDO); //Fermeture de la connexion

   ?>

 </body>

</html>
