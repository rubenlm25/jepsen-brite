<?php
session_start();
$pdo = new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
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
?>
