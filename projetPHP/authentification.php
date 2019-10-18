<html>

  <head>
    <title>Page d'authentification</title>
  </head>

  <body>

    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $id = $_POST["log"];
      $mdp = $_POST["mdp"];

      if($id == "touba8u" & $mdp == "toto"){
        echo("Vous etes connecté !");
        session_start();
        $_SESSION['login'] = $id;
        header('Location: menu_redacteur.php');
      }else{
      echo("Votre identifiant est incorrect");
      }
    }
   ?>

    <h1>Page de connexion </h1>

    <form action="authentification.php" method="post">
      <p>Login : <input type="text" name="log" /></p>
      <p>Mot de passe : <input type="password" name="mdp" /></p>
      <p><input type="submit" value="Se connecter"></p>
    </form>
  </body>

</html>
