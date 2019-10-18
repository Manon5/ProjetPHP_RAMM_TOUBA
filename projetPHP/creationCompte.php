
<html>

<head>
  <title> Création d'un compte </title>
  <head>

<body>

  <h1> Création d'un compte rédacteur : </h1>

  <form action ="creationCompte.php" method="post">

    <div>
      <label for ="nom">Votre nom : </label>
      <input type="text" name="nom" value=<?php if(isSet($_POST['nom'])) echo($_POST['nom'])?>>
    </div>

    <br />

    <div>
      <label for ="prenom">Votre prénom : </label>
      <input type="text" name="prenom" value=<?php if(isSet($_POST['prenom'])) echo($_POST['prenom'])?>>
    </div>

    <br />

    <div>
      <label for ="adresse">Votre adresse mail : </label>
      <input type="text" name="adresse" value=<?php if(isSet($_POST['adresse'])) echo($_POST['adresse'])?>>
    </div>

    <br />

    <div>
      <label for ="mdp">Votre mot de passe : </label>
      <input type="text" name="mdp" value=<?php if(isSet($_POST['mdp'])) echo($_POST['mdp'])?>>
    </div>

    <br />

    <div>
      <label for ="pseudo">Votre pseudo : </label>
      <input type="text" name="pseudo" value=<?php if(isSet($_POST['pseudo'])) echo($_POST['pseudo'])?>>
    </div>

    <br />

    <div>
      <input type="submit" value="Valider la création">
    </div>

  </form>

<!--Partie traitement des données-->

  <?php

  if(isSet($_POST['nom'])){

    if ($_POST['nom']=="")
      echo("<div id='alerteForm'> Veuillez saisir un nom </div>");

    else if ($_POST['prenom']=="")
      echo("<div id='alerteForm'> Veuillez saisir un prénom </div>");

    else if ($_POST['adresse']=="")
        echo("<div id='alerteForm'> Veuillez saisir une adresse mail </div>");

    else if ($_POST['mdp']=="")
        echo("<div id='alerteForm'> Veuillez saisir un mot de passe </div>");

    else if ($_POST['pseudo']=="")
        echo("<div id='alerteForm'> Veuillez saisir un pseudo </div>");



    }

    ?>

</body>


</html>
