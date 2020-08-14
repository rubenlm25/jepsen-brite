<?php

require_once "include/functions.php";
require_once "include/header.php";
$bdd =
    //new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
    new PDO("mysql:host=localhost;dbname=jepsen-brite", "root", "");
$id = $_GET["id"];
$action = $_GET["action"];
$userid = $_SESSION["auth"]->id;
debug($action);
if ($action == "yes") {
    $actionparticipate = $bdd->prepare("INSERT INTO participe (event_id,user_id) VALUE (?,?)");
    $actionparticipate->execute(array($id, $userid));
}
if ($action == "no") {
    $actionparticipate = $bdd->prepare("DELETE FROM participe WHERE event_id = ? AND user_id = ?");
    $actionparticipate->execute(array($id, $userid));
}

header("location:eventpage.php?id=" . $id);

