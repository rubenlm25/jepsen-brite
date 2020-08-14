
<?php
session_start();
if ($_SESSION['mdp']){

    header('Location:admin_login.php');

}

 

    require './include/header.php';
require './include/bdb.php';

    

?>

   






<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="./css/style.css">
    <!-- Bootstrap CSS -->
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
   
    <title></title>
</head>
<body>


<h1 class="container" align="center">Admin Panel</h1><br><br><br><br><br>
<div class="inline">
<div>
    <button type="button" class="btn btn-primary">
    <a href="admin_members.php" style="color: white;text-decoration: none;">gestion membres</a><br><br><br>
        </button>
</div>
<div >
    <button type="button" class="btn btn-primary">
    <a href="admin_events.php" style="color: white;text-decoration: none;">gestion Evenements</a><br><br><br>
        </button>
</div>
<div >
    <button type="button" class="btn btn-primary">
    <a href="#" style="color: white;text-decoration: none;">gestion commentaires</a><br><br><br>
        </button>
</div>
</div><br><br><br>
<div class="container btn-lg" style="margin-left: 120px;">
<button type="button" class="btn btn-danger">
    <a href="admin_logout.php" style="color: white;text-decoration: none;">log out</a>
</button>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>
</html>
