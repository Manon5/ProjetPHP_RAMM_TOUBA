<html>

  <head>
    <title>Page d'authentification</title>
  </head>

  <body>

    <?php
    include 'connexion.php';
     $co = new Connexion();


    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $id = $_POST["log"];
      $mdp = $_POST["mdp"];

      $query = $co->creer_Connexion()->query("SELECT pseudo, motdepasse, idredacteur FROM redacteur");
      $resultat = $query->fetchAll();
      $valide = 0;
      foreach ($resultat as $key => $variable){
        if($id == $resultat[$key]['pseudo'] & $mdp == $resultat[$key]['motdepasse']){
          echo("Vous etes connecté !");
          session_start();
          $_SESSION['pseudo'] = $id;
          $_SESSION['idredacteur'] = $resultat[$key]['idredacteur'];
          header('Location: accueil.php');
          $valide = 1;
        }
      }

      if($valide == 0){
        echo("Mot de passe incorrect");
      }
    }
   ?>

    <h1>Page de connexion </h1>

    <form action="authentification.php" method="post">
      <p>Login : <input type="text" autocomplete="off" name="log" /></p>
      <p>Mot de passe : <input type="password" autocomplete="off" name="mdp" /></p>
      <p><input type="submit" value="Se connecter"></p>
    </form>
  </body>

</html>
