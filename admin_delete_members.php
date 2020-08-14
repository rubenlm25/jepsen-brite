<?php
session_start();
$pdo =
    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $delete_member_info = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $delete_member_info->execute(array($getid));
    $_SESSION['flash']['success'] = "utilisateur supprimé !";
    header('Location:admin_members.php');
}else{
    $_SESSION['flash']['danger']= "utilisateur introuvable";
}



