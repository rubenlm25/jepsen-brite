<?php session_start();
require './include/functions.php'; ?>

<?php
logged_only();

?>



<?php require './include/header.php'; ?>

    <h2> My account</h2>



<?php debug($_SESSION); ?>