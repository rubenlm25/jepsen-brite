<?php
require './include/bdb.php';
// recuperation des données

$user_id = $_GET['id'];
$token = $_GET['token'];
require './include/bdb.php';
$requete = $pdo->prepare('SELECT confirmation_token FROM users WHERE id = ?');
$requete->execute([$user_id]);
$user = $requete->fetch();


if($user && $user->confirmation_token == $token ){
    //connexion utilisateur
    session_start();


    // utilisateur ne doit pas continuer à acceder à cettte page donc modi dans bdd du champs confirm at (on met à la date du jour
    // et on vide le champ confirm_token
  $requete=$pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?');
  $requete->execute(['$user_id']);
   // die('account validated');
    $_SESSION['auth'] = $user;
    header('Location:account.php');


}else{
    die('not validated account');
} // = $user['token']


?>