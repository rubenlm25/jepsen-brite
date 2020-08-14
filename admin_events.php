<?php

session_start();
$pdo = new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
if ($_SESSION['mdp']){

    header('Location:admin_login.php');

}
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
<h3 align="center">GESTION EVENEMENTS</h3>
</div>

<?php
$select_event = $pdo->query('SELECT * FROM event ORDER BY date_time DESC ');
if ($select_event->rowCount() > 0){
    while($ev = $select_event->fetch()){
        ?>
        <div class="container">
            <b><p>TITLE:<span></span> <?= $ev['title']; ?></p><p> AUTHOR:<span></span>  <?=  $ev['author']; ?> </p><p>Date et Heure: <span></span>  <?=  $ev['date_time']; ?></p>
                         </b><br><br>

            <div> <img src="<?=$ev['image'] ?>" alt="image" style="width: 200px; height: 200px;"></div>
            <br><br>
            <div>
            <a href="admin_modify_event.php?id=<?= $ev['id']; ?>" style="text-decoration: none;">Modifier</a><br><br></div>

            <a href="admin_delete.php?id=<?= $ev['id']; ?>" style="color: red;text-decoration: none;">Supprimer</a><hr/>
        </div>
        <?php

    }
}else{
    echo "aucun membre";
}

?>

<div class="container">
    <button type="button" class="btn btn-danger">
        <a href="admin_logout.php" style="color: white;text-decoration: none;">log out</a>
    </button>
</div>
<div class="container">
    <nav aria-label="...">
        <ul class="pagination">

            <li class="page-item"><a class="page-link" href="admin.php"> Previous </a></li>
            <li >
                <a class="page-link" href="">1 </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</body>
</html>