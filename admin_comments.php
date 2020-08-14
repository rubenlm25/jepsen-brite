<?php

session_start();
$pdo = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');

if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}
$email_profile = $_SESSION['mdp'];
$default = "";
$size = 100;

$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email_profile)  ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php require './include/header.php';?>
    <title>Events-Administration</title>
</head>
<body>
<div class="container">
    <h3 align="center">GESTION DES COMMENTAIRES</h3>
</div>

<?php
$select_comments = $pdo->query('SELECT * FROM comment ORDER BY date_time DESC ');

while($comment = $select_comments->fetch()){
    ?>
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><b><p> <span></span> <img src="<?php echo $grav_url; ?>" alt="gravatar_picture" style="height: 50px; width: 50px;border: 3px solid black; border-radius: 8px;"/></p></b> </li>

            </ol>
        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item " aria-current="page">PSEUDO :<b><p> <span></span> <?= $comment['author']; ?></p></b></li>
            </ol>
        </nav>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">MESSAGE : <b><p> <span></span> <?= $comment['message']; ?></p></b></li>

            </ol>
        </nav>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">DATE : <b><p> <span></span> <?= $comment['date_time']; ?></p></b> </li>

            </ol>
        </nav>



        <a href="admin_delete.php?id=<?= $comment['id']; ?>" style="color: red;text-decoration: none;font-weight: bold;">SUPPRIMER</a><hr/>
    </div>
    <?php
}

?>
<div class="container">
    <button type="button" class="btn btn-danger">
        <a href="admin_logout.php" style="color: white;text-decoration: none;">log out</a>
    </button>
</div>

</div>
</body>
</html>