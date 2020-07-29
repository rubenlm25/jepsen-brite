<?php session_start();
require './include/functions.php'; ?>

<?php
logged_only();

?>



<?php require './include/header.php'; ?>

    <h2> My account</h2>

<h4>HELLO ! <?= $_SESSION['auth']->username;?></h4>



<?php debug($_SESSION); ?>