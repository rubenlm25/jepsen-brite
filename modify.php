<?php

session_start();
$pdo = new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}
if (isset($_GET['id']) AND !empty($_GET['id'])){
        $getid = $_GET['id'];
        $select_user_info = $pdo->prepare('SELECT * FROM users WHERE  id=?');
        $select_user_info->execute(array($getid));
        $result = $select_user_info->fetch();
        if (isset($_POST['modifier_membre'])){
            $username_modify = htmlspecialchars($_POST['username']);
            $email_modify = htmlspecialchars($_POST['email']);
            $modify_info_member = $pdo->prepare('UPDATE users SET username=? AND email=? WHERE id=?');
            $modify_info_member->execute(array($username_modify, $))
        }
}else{
    $SESSION['flash']['warning'] = "utilisateur introuvable...";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier membre-Administration</title>
    <meta charset="utf-8">
    <?php
    require './include/header.php';
    ?>
</head>
<body>
<div class="container">

    <form method="POST" action="">
        <div class="form-group" action="">
            <label for="">pseudo  </label>
            <input type="text" name="username" class="form-control" value="<?= $result['username']; ?>"/>
        </div>
        <div class="form-group">
            <label for="">Email </label>
            <input type="tex" name="email" class="form-control" value="<?= $result['email']; ?>" />
        </div>
        <br><br><br>

        <button type="submit" class="btn btn-primary" name="modifier_membre">Modifier</button>
    </form>

</div>
</body>
</html>