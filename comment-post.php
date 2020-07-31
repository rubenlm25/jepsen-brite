<?php
    $id =$_GET["id"];
    $message=$_POST["comment"];
    $author=$_SESSION["auth"]->username;
    $date_time = date('Y-m-d H:i:s');
    $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
$request = $bdd -> prepare("INSERT INTO comment(author,message,id_event,date_time)VALUE (?,?,?,?)");
$request ->execute(array($author,$message,$id,$date_time));
header("location=eventpage.php?id=".$id);

?>
