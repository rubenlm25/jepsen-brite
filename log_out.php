<?php

session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "your are disconected";
header('Location: login.php');
?>