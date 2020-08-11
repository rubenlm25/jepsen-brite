<?php
session_start();
require_once './include/functions.php';
require './include/bdb.php';
$user_event = $_SESSION['auth']->username;
$request = $pdo->prepare("SELECT * FROM event where author=?");
$request->execute(array($user_event));
while ($data = $request->fetch()) {


    echo $data->title;
    echo $data->author;



}
?>