
<html>

<head>

  <?php
    include('connexion.php');
   ?>
   <meta charset = "UTF-8">
   <title> Blog pour le projet de PHP </title>
   <link rel = "stylesheet"
    type = "text/css"
    href = "styleAccueilListeArticles.css"/>
</head>

<body>

  <nav class="menu">

    <ul>
          <li> <a href="accueil.php">Retourner à l'accueil</a> </li>
          <li> <a href="listeArticles.php">Voir tous les articles</a> </li>

          <?php

          if(isSet($_SESSION['pseudo'])){

            echo(' <li class = "itemMenu"> <a href="page_redacteur.php"> Ecrire un article </a> </li>

                <li class="itemMenu"> <a href="liste_articles_perso.php" class="itemMenu"> Voir vos articles </a> </li>'
              );
          }

          ?>

    </ul>

  </nav>

  <h1> Création d'un compte rédacteur : </h1>

  <form action ="creationCompte.php" method="post">

    <div>
      <label for ="nom">Votre nom : </label>
      <input type="text" autocomplete="off" name="nom" value=<?php if(isSet($_POST['nom'])) echo($_POST['nom'])?>>
    </div>

    <br />

    <div>
      <label for ="prenom">Votre prénom : </label>
      <input type="text" autocomplete="off" name="prenom" value=<?php if(isSet($_POST['prenom'])) echo($_POST['prenom'])?>>
    </div>

    <br />

    <div>
      <label for ="adresse">Votre adresse mail : </label>
      <input type="text" autocomplete="off" name="adresse" value=<?php if(isSet($_POST['adresse'])) echo($_POST['adresse'])?>>
    </div>

    <br />

    <div>
      <label for ="mdp">Votre mot de passe : </label>
      <input type="password" autocomplete="off" name="mdp" value=<?php if(isSet($_POST['mdp'])) echo($_POST['mdp'])?>>
    </div>

    <br />

    <div>
      <label for ="mdpVerif"> Entrez à nouveau votre mot de passe : </label>
      <input type="password" autocomplete="off" name="mdpVerif" value=<?php if(isSet($_POST['mdpVerif'])) echo($_POST['mdpVerif'])?>>
    </div>

    <br />

    <div>
      <label for ="pseudo">Votre pseudo : </label>
      <input type="text" autocomplete="off" name="pseudo" value=<?php if(isSet($_POST['pseudo'])) echo($_POST['pseudo'])?>>
    </div>

    <br />

    <div>
      <input type="submit" value="Valider la création">
    </div>

  </form>

<!-- Partie traitement des données -->

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $formValide = false;  //Booleen qui verifie si le formulaire est valide

    if ($_POST['nom']=="")
      echo("<div id='alerteForm'> Veuillez saisir un nom </div>");

    else if ($_POST['prenom']=="")
      echo("<div id='alerteForm'> Veuillez saisir un prénom </div>");

    else if ($_POST['adresse']=="")
        echo("<div id='alerteForm'> Veuillez saisir une adresse mail </div>");

    else if ($_POST['mdp']=="")
        echo("<div id='alerteForm'> Veuillez saisir un mot de passe </div>");

    else if ($_POST['mdp'] != $_POST['mdpVerif'])
            echo("<div id='alerteForm'>Les mot de passe ne correspondent pas</div>");

    else if ($_POST['pseudo']=="")
        echo("<div id='alerteForm'> Veuillez saisir un pseudo </div>");
    else
        $formValide = true;       //Si on arrive ici, le formulaire est valide

    if ($formValide == true){     //Pour eviter que cette partie s'execute au chargement de la page

      $maConnexion = new Connexion();
      $objetPDO = $maConnexion->creer_Connexion();
      $statement = $objetPDO->query("SELECT pseudo,adressemail FROM redacteur"); //On prend la liste des pseudos dans la bdd

      $pseudoOk = true; //Booleen qui sert à voir si le pseudo est valide
      $adresseOk = true;

     while ($colonne = $statement->fetch()) {

       if($colonne['adressemail'] == $_POST['adresse']){

           echo("<div> Cette adresse mail est déjà attribuée, veuillez en saisir une autre.");
           $adresseOk=false;    //Si on trouve le pseudo dans la bdd, on ne fait rien
           break;

       }

        if($colonne['pseudo'] == $_POST['pseudo']){

            echo("<div> Ce pseudo est déjà utilisé, veuillez en saisir un autre");
            $pseudoOk=false;    //Si on trouve le pseudo dans la bdd, on ne fait rien
            break;

        }

      }

    if($pseudoOk == true && $adresseOk == true){  //Si le pseudo n'est pas trouvé dans la bdd

          $statement = $objetPDO->prepare("INSERT INTO redacteur(nom, prenom, adressemail, motdepasse, pseudo) VALUES(?,?,?,?,?)");

          $statement->bindValue(1, $_POST['nom']);
          $statement->bindValue(2, $_POST['prenom']);
          $statement->bindValue(3, $_POST['adresse']);
          $statement->bindValue(4, $_POST['mdp']);
          $statement->bindValue(5, $_POST['pseudo']);

          $statement->execute();           //On l'insère avec les paramètres du form
          header("Location:accueil.php");  //Et on redirige vers l'accueil
      }

    }

}


 unset($objetPDO);

    ?>

</body>

</html>
