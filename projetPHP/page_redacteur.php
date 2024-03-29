<!DOCTYPE html>

<html>

  <head lang="fr">

    <title>Nouvel article</title>

    <meta charset = "UTF-8">
    <link rel = "stylesheet"
     type = "text/css"
     href = "style.css"/>

  <?php
    session_start();
    include 'connexion.php';
   ?>

  </head>

  <body>

    <nav class="menu"> <!-- Menu du haut -->

      <ul>
            <li> <a href="accueil.php">Retourner à l'accueil</a> </li>

            <?php

            if(isSet($_SESSION['pseudo'])){

              echo('<li class="itemMenu"> <a href="listeArticles" class="itemMenu"> Voir tous les articles </a> </li>');
              echo('<li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>');
              echo("<li class='itemMenu'> <a href='javascript:if(confirm(\"Vous allez être déconnecté\")){   location.href=\"deconnexion.php\" }' > Se déconnecter </a> </li>");
            }

           ?>

      </ul>
    </nav>

    <?php

      if(isSet($_SESSION['pseudo']))
        echo('<div id="pseudo"><b> Vous êtes connecté, ' . $_SESSION['pseudo'] ." </b> </div>!");
    ?>

    <h1 class="titre">Rédaction d'un nouvel article :  </h1>

    <form action="page_redacteur.php" method="post">

      <div>
        <label for="titre"> Titre </label>
        <input id="titre" type="text" name="titre" maxlength="199" value=<?php if(isSet($_POST['titre'])) echo($_POST['titre'])?>>
      </div>

      <br />

      <div>
        <textarea name="article" rows="8" cols="45" maxlength="3999"></textarea>
      </div>

      <br />

      <div id="submitArticle">
        <input type="submit" value="Publier un article">
      </div>

    </form>

    <?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){  //Evite le chargement du script lors du premier chargement de la page

      $titre = $_POST["titre"];
      $article = $_POST["article"];

      $co = new Connexion();

       if(trim($_POST["titre"]) != "" &&  trim($_POST["article"]) != ""){

         $query = $co->creer_Connexion()->prepare("INSERT INTO sujet (idredacteur, titresujet, textesujet, datesujet)
                                                   VALUES ( ?, ?, ?, NOW())");

         //On récupère l'id du rédacteur
         $pseudo = $_SESSION['pseudo'];
         $query2 = $co->creer_Connexion()->prepare("SELECT idredacteur
                                                    FROM redacteur
                                                    WHERE pseudo = ?");
         $query2->bindValue(1, $pseudo);
         $query2->execute();

         $id = $query2->fetch()['idredacteur'];
         $query->bindValue(1, $id);

        // fin
         $query->bindValue(2, $_POST["titre"]);
         $query->bindValue(3, $_POST["article"]);
         $query->execute();

         header("Location:accueil.php");

         }

         else if(trim($_POST["titre"]) == ""){
           echo("Veuillez renseigner le titre de l'article");
         }

         else if(trim($_POST["article"]) == ""){
           echo("Veuillez renseigner le contenu de l'article");
      }

    }

     unset($objetPDO);

    ?>
  </body>

</html>
