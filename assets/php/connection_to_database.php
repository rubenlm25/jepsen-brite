<?php
	// Connection to database
	try
	{
		$database =
			// Connection to database on Heroku
			new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
            //new PDO('mysql:dbname=jepsen-brite;host=localhost', 'root', 'root');
			// Connection to database on localhost
			// new PDO('mysql:host=localhost;dbname=jepsen-brite;charset=utf8','root','');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e -> getMessage());
	}
?>