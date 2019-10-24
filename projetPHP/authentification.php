<html>

  <head>


    <title> Page d'authentification </title>

    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css"/>
    <meta charset = "UTF-8">

    <?php include 'connexion.php'; ?>

  </head>

  <body>

    <h1 class = "titre">Page de connexion </h1>

    <form action="authentification.php" method="post">   <!-- Formulaire de connexion -->

      <div>
        <label for="log">Pseudo/e-mail : </label>
        <input type="text" autocomplete="off" name="log" />
      </div>

      <br />

      <div>
        <label for="mdp"> Mot de passe : </label>
       <input type="password" autocomplete="off" name="mdp" />
     </div>

     <div class="submit">
      <input type="submit" value="Se connecter"></p>
    </div>

    </form>

    <?php

     $co = new Connexion();     //Création de la connexion sql

    if($_SERVER['REQUEST_METHOD'] == "POST"){   //Empeche l'execution du script tant qu'on a pas validé le formulaire

      $id = $_POST["log"];
      $mdp = $_POST["mdp"];

      $query = $co->creer_Connexion()->query("SELECT pseudo, motdepasse, idredacteur, adressemail
                                              FROM redacteur");
      $resultat = $query->fetchAll();
      $valide = 0;

      foreach ($resultat as $key => $variable){

        if(($id == $resultat[$key]['pseudo'] || $id == $resultat[$key]['adressemail']) & $mdp == $resultat[$key]['motdepasse']){

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

     unset($objetPDO);

   ?>

  </body>

</html>
