<?php
function debug($variable){
    echo'<pre>' .print_r($variable, true) . '</pre>';
}

function str_random($lenght){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
  return substr( str_shuffle( str_repeat($alphabet, $lenght)),0, $lenght );
}

function logged_only(){

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    if (! isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "to access to your account please login or Sign Up !";
        header('Location: login.php');
        exit();
    }
}