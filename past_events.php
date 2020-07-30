<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="assets/scss/header_style.css">
		<link rel="stylesheet" href="assets/scss/footer_style.css">
		<link rel="stylesheet" href="assets/scss/past_events_main_part_style.css">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<title>
			Past Events
		</title>
	</head>
	
	
	<body>
		<?php
			require "include/header.php";
		?>


		<main>
			<h2>
				Past Events
			</h2>

			<div class='cards_container'>
				<?php
					require "assets/php/past_events_php_code.php";
				?>
			</div>
		</main>


		<?php
			require "footer.php";
		?>
	</body>
</html>