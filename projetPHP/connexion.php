<?php

class Connexion{

  private $url;
  private $login;
  private $password;

  public function __construct(){

    $this->url = 'mysql:host=devbdd.iutmetz.univ-lorraine.fr;dbname=ramm8u_projetPHP;port=3306' ;
    $this->login = '' ;     //Inserez ici votre login
    $this->password = '' ; //Inserez ici votre mdp

  }

  public function creer_Connexion(){

    try{

      $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
      $bdd= new PDO($this->url,$this->login,$this->password, $options);
      return $bdd;

    }

    catch(Exception $e){
      echo($e->getMessage());
    }

  }

}

 ?>
