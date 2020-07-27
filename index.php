<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="assets/scss/index_header_part_style.css">
		<link rel="stylesheet" href="assets/scss/index_main_part_style.css">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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
						<a href="" title="Create an event">Create Event</a>
					</li>
					<li>
						<a href="" title="See past events">Past Events</a>
					</li>
					<li>
						<a href="" title="Go to your profile">Profile</a>
					</li>
					<li>
						<a href="" title="Register">Sign Up</a>
					</li>
					<li>
						<a href="" title="Log in to your account">Log In</a>
					</li>
				</ul>
			</nav>
		</header>


		<main>
			<h2>
				Upcoming Events
			</h2>
		
			<div class='cards_container'>
				<?php
					include('assets/php/index_php_code.php');
				?>
			</div>
		</main>


		<footer>
		</footer>
	</body>
</html>