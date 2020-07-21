<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Homepage
		</title>
	</head>
	
	<body>
		<?php
			try
			{
				$database = new PDO('mysql:host=localhost;dbname=jepsen-brite;charset=utf8', 'root', '');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e -> getMessage());
			}

			$response = $database -> query('SELECT * FROM users');

			while ($data = $response -> fetch())
			{
				echo $data['nickname'];
			}

			$response -> closeCursor();
		?>
		
		
		<header>
			<nav>
				<ul>
					<li>
						<h1>
							Jepsenbrite
						</h1>
					</li>
					<li>
						Create event
					</li>
					<li>
						Past events
					</li>
					<li>
						Profile
					</li>
					<li>
						Sign up
					</li>
					<li>
						Log in
					</li>
				</ul>
			</nav>
		</header>


		<main>
			<h2>
				Upcoming events
			</h2>
			
			
			<!-- Template qui sera utilisé par PHP pour générer les events -->
			<template>
				<div>
					<!-- Image de l'event -->
					<figure>
						<img src="" alt="">
					</figure>

					<!-- Titre de l'event -->
					<h3>
						<?php
							// echo $data['nickname'];
						?>
					</h3>

					<!-- Date et heure de l'event -->
					<ul>
						<li>
						</li>
						<li>
						</li>
					</ul>

					<!-- Bouton qui envoie sur la page event pour le voir en détail -->
					<button>
					</button>
				</div>
			</template>
		</main>

		<?php
			// $reponse -> closeCursor();
		?>
	</body>
</html>