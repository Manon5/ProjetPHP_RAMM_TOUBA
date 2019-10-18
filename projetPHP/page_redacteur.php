<html>

  <head>
    <title>Nouvel article</title>
  </head>

  <body>

    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $titre = $_POST["titre"];
      $article = $_POST["article"];

      echo ("L'article '" . $titre . "'  a bien été publié ! ");


    }
   ?>

    <h1>Rédaction d'un nouvel article :  </h1>

    <form action="page_redacteur.php" method="post">
      <p>Titre : <input type="text" name="titre" /></p>
      <p>Contenu de l'article : <br />
        <textarea name="article" rows="8" cols="45">
          Saisissez votre article ici.
        </textarea></p>
      <p><input type="submit" value="Publier un article"></p>
    </form>
  </body>

</html>
