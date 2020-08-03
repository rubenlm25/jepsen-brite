<?php

$pdo =
   // new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
     new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', '');
// definir atribut PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// renvoi les erreurs PDO pour les capturer si besoin
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);// recupere sous forme d'objet