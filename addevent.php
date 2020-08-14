<?php

require './include/functions.php';
require_once './include/bdb.php';
logged_only();
if (isset($_POST['addevent']) ){
	$title = $_POST["title"];
	$author = $_SESSION["auth"] -> username;
	$date_time = $_POST['date_time'];
	$description = $_POST["description"];
	$category = $_POST["category"];
	$sous_category=$_POST["sous_category"];
	$address = $_POST["address"];
	$postal = $_POST["postal_code"];
	$city = $_POST["city"];

	$image_name = $_FILES['image']['name'];
	$image_tmp_name = $_FILES['image']['tmp_name'];
	$image_tmp_name = file_get_contents($image_tmp_name);
	$image_type = pathinfo($image_name, PATHINFO_EXTENSION);

	$allowed_filetypes = ["jpg", "jpeg", "png", "gif"];
    echo "category".$category."sous category".$sous_category."title".$title."author".$author."date_time".$date_time."description".$description;
	function send_data($title, $author, $date_time, $description, $category, $image_tmp_name, $image_type,$sous_category,$address,$postal,$city)
	{
		$bdd =
			new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
			 //new PDO("mysql:host=localhost;dbname=jepsen-brite","root","root");
		$request = $bdd -> prepare("INSERT INTO event(title, author, date_time, description, image, image_type,category,sous_category,address,postal_code,city) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?)");
		$request -> execute(array($title, $author, $date_time, $description, $image_tmp_name, $image_type,$category,$sous_category,$address,$postal,$city));
        $lastid = $bdd ->lastInsertId();
//        header("location:eventpage.php?id=".$lastid);
	}

	if ($image_type === $allowed_filetypes[0])
	{
		$image_tmp_name = "data:image/jpg;base64," . base64_encode($image_tmp_name);
        send_data($title, $author, $date_time, $description, $category,  $image_tmp_name, $image_type,$sous_category,$address,$postal,$city);	}
	else if ($image_type === $allowed_filetypes[1])
	{
		$image_tmp_name = "data:image/jpeg;base64," . base64_encode($image_tmp_name);
        send_data($title, $author, $date_time, $description, $category, $image_tmp_name, $image_type,$sous_category,$address,$postal,$city);	}
	else if ($image_type === $allowed_filetypes[2])
	{
		$image_tmp_name = "data:image/png;base64," . base64_encode($image_tmp_name);
        send_data($title, $author, $date_time, $description, $category, $image_tmp_name, $image_type,$sous_category,$address,$postal,$city);	}
	else if ($image_type === $allowed_filetypes[3])
	{
		$image_tmp_name = "data:image/gif;base64," . base64_encode($image_tmp_name);
		send_data($title, $author, $date_time, $description, $category, $image_tmp_name, $image_type,$sous_category,$address,$postal,$city);
	}
	else
	{
		echo 'Please enter a picture of ".jpg", ".jpeg", ".png" or ".gif" type.';
	}

}

?>

<html>
<head>
	<meta charset="utf-8" />
	<title>Create Event</title>
    <?
    require './include/header.php';
    ?>
</head>
<body>
	<main>
		<h1 style="text-align: center; font-family: 'Comfortaa', cursive; font-size: 200%;">Create Event</h1>
		<form  method="post" action="addevent.php" enctype="multipart/form-data" class="container" style="width: 50%; margin-bottom: 20px;">
			<div class="form-group">
				<label for="title" style="font-size: 110%;">Title</label>
				<input type="text" name="title" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="date_time" style="font-size: 110%;">Date and Time</label>
				<input type="datetime-local" name="date_time" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="image" style="font-size: 110%;">Image</label>
				<input type="file" required name="image" class="form-control-file">
			</div>
			<div class="form-group">
				<label for="description" style="font-size: 110%;">Description</label>
				<input type="text" name="description" required class="form-control">
			</div>
            <div class="form-group">
                <label for="address" style="font-size: 110%;">Address</label>
                <input type="text" name="address" required class="form-control">
            </div>
            <div class="form-group">
                <label for="postal_code" style="font-size: 110%;">Postal Code</label>
                <input type="number" name="postal_code" required class="form-control" min="1000">
            </div>
            <div class="form-group">
                <label for="city" style="font-size: 110%;">City</label>
                <input type="text" name="city" required class="form-control">
            </div>
			<div class="form-group">
				<label for="category" style="font-size: 110%;">category</label>
				<select name="category" class="form-control">

                <?php
                $bdd =
                    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
                    //new PDO("mysql:host=localhost;dbname=jepsen-brite","root","root");
                    $category = $bdd->query("SELECT * FROM category");
                    $sous_category = $bdd ->query("SELECT * FROM sous_category ");
                    while ($data = $category->fetch()){
                        echo "<option value='".$data["title"]."'>".$data["title"]."</option>";

                    }
                    echo "</select>";
                    while ($data =$sous_category->fetch()){
                        echo "<span class='form-control'>".$data["title"]."</span><input type='radio' name='sous_category' value='".$data["title"]."' >";
                    }

?>

			</div>
			<button type="submit" name="addevent" class="btn btn-primary">Add Event</button>
		</form>
	</main>
</body>
</html>