<?php
$title = $_POST["title"];
$datehour=$_POST["datehour"];
$image = $_POST["imgdata"];
$description = $_POST["description"];
$category = $_POST["category"];


echo $image;

$bdd = new PDO("mysql:host=localhost;dbname=jepsen-brite","root","root");
$request = $bdd ->prepare("INSERT INTO `event`(`Title`, `datehour`, `image`, `description`, `category`) VALUES (?,?,?,?,?)");
$request ->execute(array($title,$datehour,$image,$description,$category));
//header("location:successfull.php");
