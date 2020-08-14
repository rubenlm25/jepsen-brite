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
    header('Location:admin_events.php');
}else{
    $_SESSION['flash']['danger']= "utilisateur introuvable";
}

if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $delete_events = $pdo->prepare('DELETE FROM event WHERE id = ?');
    $delete_events->execute(array($getid));
    $_SESSION['flash']['success'] = "event delete successfully !";
    header('Location:admin_events.php');
}else{
    $_SESSION['flash']['danger']= "événement  introuvable";
}

if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $delete_com = $pdo->prepare('DELETE FROM comment WHERE id = ?');
    $delete_com->execute(array($getid));
    $_SESSION['flash']['success'] = "comment delete successfully !";
    header('Location:admin_comments.php');
}else{
    $_SESSION['flash']['danger']= "commentaire  introuvable";
}

?>