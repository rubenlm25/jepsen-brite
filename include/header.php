<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
		?>
<!doctype html>
<body lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v4.0.1">
	<title>jepsen-brite</title>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-static/">
	<!-- Bootstrap core CSS -->
	<link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
	<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
	<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#563d7c">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="css/app.css">
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<!-- Custom styles for this template -->
	<link href="navbar-top.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
	<a class="navbar-brand" href="index.php" style="font-family: 'Comfortaa', cursive; font-size: 300%;">Jepsen-brite</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="navbar-nav mr-auto">
			<?php if (isset($_SESSION['auth'])): ?>

			<li class="nav-item">
				<a class="nav-link" href="log_out.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Log Out</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="past_events.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Past Events</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="account.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="addevent.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Create Events</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="categorypage.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Categories</a>
			</li>

			<?php else: ?>

			<li class="nav-item active">
				<a class="nav-link" href="register.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Sign In<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="login.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Log In</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="past_events.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Past Events</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="categorypage.php" tabindex="-1" aria-disabled="true" style="font-family: 'Comfortaa', cursive; font-size: 125%;">Categories</a>
			</li>

			<?php endif; ?>
		</ul>
	</div>
</nav>
<div class="container">

	<?php if (isset($_SESSION['flash'])): ?>
	<?php foreach($_SESSION['flash'] as $type => $message): ?>

	<div class="alert alert-<?= $type; ?>">
		<?= $message; ?>
	</div>
	<?php endforeach; ?>
		<?php unset($_SESSION['flash']); ?>
	<?php endif; ?>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script></body>
</body>
</html>

