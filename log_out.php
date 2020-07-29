<?php

session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "you have been succesfully disconected !";
header('Location: login.php');
?>