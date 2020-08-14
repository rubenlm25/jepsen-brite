<?php

session_start();
$pdo = new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
if (!$_SESSION['mdp']){

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
    <h3 align="center">GESTION DES COMMENTAIRES</h3>
</div>

</body>
</html>