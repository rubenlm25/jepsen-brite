<?php
	// Connection to database
	try
	{
		$database = new PDO
		// Connection to database on Heroku
		('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');

		// Connection to database on localhost
		// ('mysql:host=localhost;dbname=jepsen-brite;charset=utf8','root','');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e -> getMessage());
	}
?>