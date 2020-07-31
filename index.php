<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="assets/scss/index_main_part_style.css">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<title>
			Homepage
		</title>
	</head>
	
	
	<body>
		<?php
			require "include/header.php";
		?>


		<main>
			<h2>
				Upcoming Events
			</h2>

			<div class='cards_container'>
				<?php
					require "assets/php/index_php_code.php";
				?>
			</div>
		</main>


		<?php
			require "footer.php";
		?>
	</body>
</html>