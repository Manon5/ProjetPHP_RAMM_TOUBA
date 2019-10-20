<html>

  <head>
    <title>Nouvel article</title>
  </head>

  <body>

    <nav>
      <a href = "http://localhost/PROJETPHP/projetPHP/accueil.php"> Retour à l'accueil </a>
      <a href = "http://localhost/PROJETPHP/projetPHP/listeArticles.php?" > Voir tous les articles </a>
      <?php
      session_start();
      if(isset($_SESSION['pseudo'])){
        echo("<a href='#' onclick='alert('MonAlerte');return false;' > Se déconnecter </a>");
      } ?>
    </nav>

    <h1>Rédaction d'un nouvel article :  </h1>

    <?php
    echo("Bienvenue, " .   $_SESSION['pseudo'] . " !"); ?>



    <form action="page_redacteur.php" method="post">
      <p>Titre : <input type="text" name="titre" /></p>
      <p>Contenu de l'article : <br />
        <textarea name="article" rows="8" cols="45">Saisissez votre article ici.</textarea></p>
      <p><input type="submit" value="Publier un article"></p>
    </form>


    <?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $titre = $_POST["titre"];
      $article = $_POST["article"];

      include 'connexion.php';
       $co = new Connexion();

       if(trim($_POST["titre"]) != "" &&  trim($_POST["article"]) != ""){
         $query = $co->creer_Connexion()->prepare("INSERT INTO sujet (idredacteur, titresujet, textesujet, datesujet) VALUES ( ?, ?, ?, NOW())");

         // on chope l'id du rédacteur
         $pseudo = $_SESSION['pseudo'];
         $query2 = $co->creer_Connexion()->prepare("SELECT idredacteur FROM redacteur WHERE pseudo = ?");
         $query2->bindValue(1, $pseudo);
         echo($pseudo);
         $query2->execute();
         $id = $query2->fetch()['idredacteur'];
         echo($id);
         $query->bindValue(1, $id);

        // fin
         $query->bindValue(2, $_POST["titre"]);
         $query->bindValue(3, $_POST["article"]);
         $query->execute();
        echo ("L'article '" . $titre . "'  a bien été publié ! ");
      }else if(trim($_POST["titre"]) == ""){
        echo("Veuillez renseigner le titre de l'article");
      }else{
        echo("Veuillez renseigner le contenu de l'article");
      }



    }
    ?>
  </body>

</html>
