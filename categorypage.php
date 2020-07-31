
<html>
<<<<<<< HEAD
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="category_style.css">
		<title>category page</title>
	</head>
	<body>
		<?php require "include/header.php"; ?>
		<main>
			<h1 style="font-family: 'Comfortaa', cursive; font-size: 200%; text-align: center;">category page</h1>
			<h2 style="font-size: 150%; text-align: center;">Choose a category</h2>
			<form method="post" action="categorypage.php" style="width: 50%; margin: 0 auto 20px auto;">
				<div class="form-group">
					<label for="category" style="font-size: 150%;">category</label>
					<select name="category" class="form-control">
						<option value="party">party</option>
						<option value="concert">concert</option>
						<option value="meeting">meeting</option>
						<option value="festival">festival</option>
					</select>
				</div>
				<input type="submit" name="submit" value="submit">
			</form>
			<?php
			if (isset($_POST["submit"])){
				$choice = $_POST["category"];
				$bdd =
					new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
					// new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
				$request =$bdd->prepare("SELECT * FROM event WHERE category = ? ");
				$request ->execute(array($choice));
				$actualdate = date('Y-m-d H:i:s');
				if (isset($_SESSION['auth']))
				{
					$test = $_SESSION['auth']->username;
				}
		
				while($data = $request->fetch()){
					// echo "<p>titre : ".$data["title"]."</p>";
					$usersession = $data["author"];
					echo
						"<div class='card' style='width: 50%; margin: 0 auto 20px auto;'>
							<img src='".$data['image']."' alt='Logo' class='card-img-top'>
							<div class='card-body'>
								<h3 class='card-title'>
									".$data["title"]."
								</h3>
								<div class='card-text'>
									<span class='font-weight-bold'>Date and time :</span><br>".$data["date_time"]."
								</div>
								<div class='card-text'>
									<span class='font-weight-bold'>Description :</span><br>".$data["description"]."
								</div>
								<div class='card-text'>
									<span class='font-weight-bold'>Category :</span><br>".$data["category"]."
								</div>
								<div>
									<a href='eventpage.php?id=".$data["id"]."' class='card-link'>see event</a>
								</div>
							</div>
						</div>"
					;
					
				}
			}
		?>
=======
    <head>
        <meta charset="utf-8" />
        <title>category page</title>
    </head>
    <body>
        <main>
            <h1>category page</h1>
            <h2>Choice one category</h2>
            <form  method="post" action="categorypage.php">
                <div>
                    <label for="category">category</label>
                    <select name="category">
                        <option value="party">party</option>
                        <option value="concert">concert</option>
                        <option value="meeting">meeting</option>
                        <option value="festival">festival</option>
                    </select>
                </div>
                <input type="submit" name="submit" value="submit">
            </form>
            <?php
            if (isset($_POST["submit"])){
                $choice = $_POST["category"];
                $bdd =
                    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
                    // new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
                $request =$bdd->prepare("SELECT * FROM event WHERE category = ? ");
                $request ->execute(array($choice));
                while($data = $request->fetch()){
                            echo "<div>
                            <p>title : ".$data["title"]."</p>
                            <p>date and hour :".$data["date_hour"]."</p>
                            <a href='eventpage.php?id=".$data["id"]."'>
                        </div>";
                    }
                }
            ?>
>>>>>>> 3a461880003652092bfef2e0086e884803565217

		</main>
	</body>
</html>
