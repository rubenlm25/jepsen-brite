<?php
	require "include/functions.php";
	// require_once "include/bdb.php";
	require "include/navbar.php";

	logged_only();

	$usersession = $_SESSION["auth"] -> username;
	$id = $_GET["id"];
	$bdd =
			//new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
			 new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
			
	$request = $bdd -> prepare("SELECT author FROM event WHERE id=?");
	$request -> execute(array($id));
	$test = $request->fetch();
	
	if ($usersession == $test["author"]){


	if (isset($_POST["editevent"]))	{
		$id = $_POST["id"];
		$title = $_POST["title"];
		$date_time = $_POST["date_time"];
		$description = $_POST["description"];
		$category = $_POST["category"];
		$image = $_FILES['image']['name'];
		
		
		if(empty($image)){
			$request = $bdd -> prepare("UPDATE event SET title=?,date_time=?,description=?,category=? WHERE id=?");
			$request -> execute(array($title,$date_time,$description,$category,$id));
		}
		else{
			$image_name = $_FILES['image']['name'];
			$image_tmp_name = $_FILES['image']['tmp_name'];
			$image_tmp_name = file_get_contents($image_tmp_name);
			$image_type = pathinfo($image_name, PATHINFO_EXTENSION);
			$allowed_filetypes = ["jpg", "jpeg", "png", "gif"];

			if ($image_type === $allowed_filetypes[0]) {
				$image_tmp_name = "data:image/jpg;base64," . base64_encode($image_tmp_name);
			} else if ($image_type === $allowed_filetypes[1]) {
				$image_tmp_name = "data:image/jpeg;base64," . base64_encode($image_tmp_name);
			} else if ($image_type === $allowed_filetypes[2]) {
				$image_tmp_name = "data:image/png;base64," . base64_encode($image_tmp_name);
			} else if ($image_type === $allowed_filetypes[3]) {
				$image_tmp_name = "data:image/gif;base64," . base64_encode($image_tmp_name);
			} else {
				echo 'Please enter a picture of ".jpg", ".jpeg", ".png" or ".gif" type.';
			}
			$request = $bdd->prepare("UPDATE event SET title=?,date_time=?,image=?,image_type=?,description=?,category=? WHERE id=?");
			$request->execute(array($title, $date_time, $image_tmp_name, $image_type, $description, $category, $id));

		}

		header("location:eventpage.php?id=".$id);
	}
echo "<html>
		<head>
	<meta charset='utf-8' />
	<link href='https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap' rel='stylesheet'>
	<title>edit event</title>
</head>
<body>
<main>
	<h1 style='text-align: center; font-family: Comfortaa, cursive; font-size: 300%;'>Edit Event</h1>";

	$id = $_GET["id"];
	$bdd =
		new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
		// new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
	$request = $bdd ->prepare("SELECT * FROM event where id=?");
	$request ->execute(array($id));
	$data = $request->fetch();
	$date_time_default= $data["date_time"];
	$date_time_default = date('Y-m-d\TH:i:s',strtotime($date_time_default));
	echo "<form  method=\"post\" action=\"editevent.php?id=".$id."\" enctype=\"multipart/form-data\" style='width: 50%; margin: 0 auto 20px auto;'>
		<input type='text' hidden name='id' value='".$id."'>
		<div class='form-group'>
			<label for=\"title\">Title</label>
			<input type=\"text\" name=\"title\" required value='".$data["title"]."' class='form-control'>
		</div>
		<div class='form-group'>
			<label for=\"date_time\">Date and Time</label>
			<input type=\"datetime-local\" name=\"date_time\" value='".$date_time_default."' class='form-control'>
		</div>
		<div class='form-group'>
			<label for=\"image\">Image</label>
			<input type=\"file\" name=\"image\" class='form-control'>
			<img src='".$data["image"]."' style='width: 100%;'>
		</div>
		<div class='form-group'>
			<label for=\"description\">Description</label>
			<input type=\"text\" name=\"description\" value='".$data["description"]."' class='form-control'>
		</div>";
		if($data["category"] == "party"){
			echo "<div class='form-group'>
			<label for=\"category\">category</label>
			<select name=\"category\" class='form-control'>
				<option value=\"party\"selected='selected'>party</option>
				<option value=\"concert\">concert</option>
				<option value=\"meeting\">meeting</option>
				<option value=\"festival\">festival</option>
			</select>
		</div>";
		}
		if ($data["category"] == "concert"){
			echo "<div class='form-group'>
			<label for=\"category\">category</label>
			<select name=\"category\" class='form-control'>
				<option value=\"party\">party</option>
				<option value=\"concert\"selected='selected'>concert</option>
				<option value=\"meeting\">meeting</option>
				<option value=\"festival\">festival</option>
			</select>
		</div>";
		}
		if ($data["category"] == "meeting"){
			echo "<div class='form-group'>
			<label for=\"category\">category</label>
			<select name=\"category\" class='form-control'>
				<option value=\"party\">party</option>
				<option value=\"concert\">concert</option>
				<option value=\"meeting\"selected='selected'>meeting</option>
				<option value=\"festival\">festival</option>
			</select>
		</div>";
		}
		if ($data["category"] == "festival"){
			echo "<div class='form-group'>
			<label for=\"category\">category</label>
			<select name=\"category\" class='form-control'>
				<option value=\"party\">party</option>
				<option value=\"concert\">concert</option>
				<option value=\"meeting\">meeting</option>
				<option value=\"festival\"selected='selected'>festival</option>
			</select>
		</div>";
		}
		echo "
		<button type='submit' name='editevent' class='btn btn-primary'>Edit Event</button>
	</form>



</main>
</body>
</html>";
	}
	else{
		echo "<html>
		<head>
	<meta charset='utf-8' />
	<title>edit event</title>
</head>
<body>
<h1>You don't have permission to edit this event as you are not the author.</h1>
</body>
</html>
";
	}
?>