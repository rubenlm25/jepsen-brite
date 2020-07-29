<?php session_start();
require './include/functions.php';
require_once './include/bdb.php';

require './include/header.php';


logged_only();




    debug($_SESSION);

?>

<h2>bonjour</h2>
<h3>pseudo:  <?= $_SESSION['auth']->username; ?></h3>







