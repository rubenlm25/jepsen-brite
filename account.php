<?php session_start();
require './include/functions.php';
require_once './include/bdb.php';

require './include/header.php';


logged_only();

if (!empty($_POST['avatar']))


    debug($_SESSION);

?>
<div class="container" align = "center">
    <h2>HELLO <?= $_SESSION['auth']->username; ?> Welcome to Jepsen-Brite!</h2>

</div>
<div class="container">
    <h3>User informations</h3>
    <h4> Your Pseudo :    <?= $_SESSION['auth']->username; ?></h4>
    <h4>Your Email : <?= $_SESSION['auth']->email; ?></h4>

</div>

</div>