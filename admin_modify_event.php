<?php

session_start();
$pdo =
    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}


if (isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $select_event_info = $pdo->prepare('SELECT * FROM event WHERE  id=?');
    $select_event_info->execute(array($getid));
    $result = $select_event_info->fetch();
    if (isset($_POST['modifier_event'])){
        $author_modify = htmlspecialchars($_POST['author']);
        $title_modify = htmlspecialchars($_POST['title']);
        $date_time_modify = htmlspecialchars($_POST['date_time']);
        $image_modify = $_POST['image'];
        $description_modify = htmlspecialchars($_POST['description']);
        $modify_author_event = $pdo->prepare('UPDATE event SET author=?  WHERE id=?');
        $modify_author_event->execute(array($author_modify, $getid));
        $modify_title_event = $pdo->prepare('UPDATE event SET title=?  WHERE id=?');
        $modify_title_event->execute(array($title_modify, $getid));
        $modify_date_time_event = $pdo->prepare('UPDATE event SET date_time=? WHERE id=?');
        $modify_date_time_event->execute(array($date_time_modify, $getid));

        //$modify_image_event = $pdo->prepare('UPDATE event SET image=? WHERE id=?');
       // $modify_image_event->execute(array($image_modify, $getid));

        $_SESSION['flash']['success'] = "les info event ont bien été modifiée";
        header('Location:admin_events.php');
        //

    }
}else{
    $SESSION['flash']['warning'] = "utilisateur introuvable...";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier event-Administration</title>
    <meta charset="utf-8">
    <?php
    require './include/header.php';
    ?>
</head>
<body>
<div class="container">

    <form method="POST" action="">
        <div class="form-group" action="">
            <label for=""><b>AUTEUR</b>  </label>
            <input type="text" name="author" class="form-control" value="<?= $result['author']; ?>"/>
        </div>
        <div class="form-group">
            <label for=""><b>TITRE</b> </label>
            <input type="text" name="title" class="form-control" value="<?= $result['title']; ?>" />
        </div>
        <div class="form-group">
            <label for=""><b>DATE & HEURE</b> </label>
            <input type="text" name="date" class="form-control" value="<?= $result['date_time']; ?>" />
        </div>
        
        <br><br><br>

        <button type="submit" class="btn btn-primary" name="modifier_event">Modifier</button>
    </form>

</div>
</body>
</html>