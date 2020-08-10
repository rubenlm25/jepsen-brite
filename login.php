<?php
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once './include/bdb.php';
    require_once './include/functions.php';

    $requete = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username ) AND confirmed_at IS NOT NULL');
    $requete->execute(['username' => $_POST['username']]);
        $user = $requete->fetch();

       // debug (password_verify ($_POST['password'], $user->password));
        if(password_verify($_POST['password'], $user->password)){
            session_start();
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = "Congratulation you are connected! to Jepsen-Brite";
            header('Location: account.php');
            exit();

        }else{
            $_SESSION['flash']['danger'] = "Incorrect username or password !";
        }
    //debug($_SESSION);
}

?>




<?php require './include/header.php'; ?>

<h2 class="container"> LOGIN</h2>


<form  action="" method="POST" enctype="multipart/form-data" class="container"  >
    <div class="form-group">
        <label for="">Pseudo or email : </label>
        <input type="text" name="username" class="form-control" />
    </div>
    <div class="form-group">
        <label for="">Password : </label>
        <input type="password" name="password" class="form-control" />
    </div>
    <div>
    <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>




