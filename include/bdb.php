<?php

$pdo = new PDO('mysql:dbname=jepsen_brite;host=localhost', 'root', '');
// definir atribut PDO
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// renvoi les erreurs PDO pour les capturer si besoin
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);// recupere sous forme d'objet