<?php
require './include/bdb.php';
// recuperation des données

$user_id = $_GET['id'];
$token = $_GET['token'];
require './include/bdb.php';
$requete = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$requete->execute([$user_id]);
$user = $requete->fetch();
session_start();

if($user && $user->confirmation_token == $token ){
    //connexion utilisateur

    // utilisateur ne doit pas continuer à acceder à cette page donc modi dans bdd du champs confirm at (on met à la date du jour
    // et on vide le champ confirm_token
    $requete=$pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?');
    $requete->execute([$user_id]);
    $_SESSION['flash']['success'] ="your account is successfully created !";
    $_SESSION['auth'] = $user;
    header('Location:account.php');


}else{
    $_SESSION['flash']['danger'] = "This token is no more valid";

    header('Location: login.php');
}


?>