<?php
session_start();
$pdo = new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}
?>
<?php
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
<?php
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $delete_events = $pdo->prepare('DELETE FROM event WHERE id = ?');
    $delete_events->execute(array($getid));
    $_SESSION['flash']['success'] = "event delete successfully !";
    header('Location:admin_events.php');
}else{
    $_SESSION['flash']['danger']= "événement  introuvable";
}
?>

<?php
if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid_com = $_GET['id'];
    $delete_com = $pdo->prepare('DELETE FROM comment WHERE id = ?');
    $delete_com->execute(array($getid_com));
    $_SESSION['flash']['success'] = "comment delete successfully !";
    header('Location:admin_comments.php');
}else{
    $_SESSION['flash']['danger']= "commentaire  introuvable";
}

?>


