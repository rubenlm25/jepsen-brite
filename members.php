<?php

session_start();
$pdo = new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Membres-Administration</title>
    <meta charset="utf-8">
    <?php
    require './include/header.php';
    ?>
</head>
<body>
<?php
$select_users = $pdo->query('SELECT * FROM users');
if ($select_users->rowCount() > 0){
    while($m = $select_users->fetch()){
        ?>
        <div class="container">
        <b><?=  $m['username']; ?>  <?=  $m['email']; ?></b> <a href="modify.php?id=<?= $m['id']; ?>">Modifier</a><hr/>
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

    <li class="page-item"><a class="page-link" href="admin.php">previous </a></li>
    <li >
      <a class="page-link" href="">1 </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</div>
</body>
</html>
