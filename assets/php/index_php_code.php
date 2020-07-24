<?php
	// Connection to database
	try
	{
		$database = new PDO('mysql:host=localhost;dbname=jepsen-brite;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e -> getMessage());
	}

	// Request from database
	$response = $database -> query('SELECT * FROM event');

	// Loop on all elements from the table event
	while ($data = $response -> fetch())
	{
		echo
			"<div>
				<!-- Image de l'event -->
				<figure>
					<img src='".$data['image']."' alt='Logo'>
				</figure>

				<!-- Titre de l'event -->
				<h3>".$data['title']."</h3>

				<!-- Date et heure de l'event -->
				<ul>
					<li>".date('d-m-Y', strtotime($data['date']))."</li>
					<li>".date('H:i', strtotime($data['time']))."</li>
				</ul>

				<!-- Bouton qui envoie sur la page event pour le voir en détail -->
				<button>
				</button>
			</div>"
		;
	}

	$response -> closeCursor();
?>