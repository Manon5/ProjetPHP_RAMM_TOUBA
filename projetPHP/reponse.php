
<html>

<head>

  <?php
  session_start();
    include('connexion.php');
   ?>

  <title> Rédaction d'une réponse </title>
  <meta charset = "UTF-8">
  <title> Mes articles </title>
  <link rel = "stylesheet"
   type = "text/css"
   href = "style.css"/>

 </head>

<body>

  <h1 class="titre">Rédaction d'une réponse : </h1>

  <form action =<?php echo ('reponse.php?idsujet=' . $_GET['idsujet'])?> method="post">

    <div>
      <textarea name="textereponse" rows="8" cols="40"> </textarea>
    </div>

    <div class="submit">
      <input type='submit' value='Validez votre réponse'> </input>
    </div>

  </form>

<!-- Partie traitement des données -->

<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){

  $maConnexion = new Connexion();
  $objetPDO = $maConnexion->creer_Connexion();

      $statement = $objetPDO->prepare("INSERT INTO reponse(idsujet,idredacteur,daterep,textereponse) VALUES(?,?,NOW(),?)");

      $statement->bindValue(1,$_GET['idsujet']);
      $statement->bindValue(2,$_SESSION['idredacteur']);
      $statement->bindValue(3,$_POST['textereponse']);

      $statement->execute();

      header("Location: blog.php?idsujet=" . $_GET['idsujet']);


}
    ?>

</body>

</html>
