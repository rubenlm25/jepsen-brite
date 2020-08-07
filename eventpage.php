
<html style="position: relative; min-height: 100%;;">
	<head>
		<meta charset="utf-8" />
		<title>event page</title>
	</head>
	<body>
		<main>
			<?php
			require_once "./include/functions.php";
			require_once "./include/bdb.php";
			require "./include/navbar.php";
				$id = $_GET["id"];
				$bdd =
					//new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
					 new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
				$request = $bdd ->prepare("SELECT * FROM event where id=?");
				$request ->execute(array($id));
				$data = $request->fetch();
            if(isset($_SESSION['auth'])){
                $usersession = $_SESSION["auth"] -> username;
            }
            else{
                $usersession=null;
            }

				$auth = $bdd -> prepare("SELECT author FROM event WHERE id=?");
				$auth -> execute(array($id));
				$test = $auth->fetch();
				$actualdate = date('Y-m-d H:i:s');
			

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
							</div>";
							if ($usersession === $test["author"] && $data["date_time"] > $actualdate){
								echo
								"<div>
									<a href='editevent.php?id=".$data["id"]."' class='card-link'>Edit this event</a>"
								;
							}
						"</div>
					</div>"
				;
			?>
		</main>

	</body>
</html>



