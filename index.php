<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="assets/scss/index_style.css">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
		<title>
			Homepage
		</title>
	</head>
	
	<body>
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
		
			<?php
				include('assets/php/index_php_code.php');
			?>
		</main>
	</body>
</html>