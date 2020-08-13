<?php
require './include/functions.php';
require_once './include/bdb.php';

logged_only();
if (isset($_POST['addevent']) ) {
    $title = $_POST["title"];
    $author = $_SESSION["auth"]->username;;
    $date_time = $_POST['date_time'];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $sous_category= $_POST["sous_category"];
    $video = $_POST["video"];

    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    if(!empty($_FILES['image']['tmp_name'])
        && file_exists($_FILES['image']['tmp_name'])) {
        $image_tmp_name= file_get_contents($image_tmp_name);
    }
    // $image_tmp_name = file_get_contents($image_tmp_name);
    $image_type = pathinfo($image_name, PATHINFO_EXTENSION);


    $allowed_filetypes = ["jpg", "jpeg", "png", "gif"];

    function send_data($title, $author, $date_time, $description, $image_tmp_name, $image_type, $category, $sous_category, $video)
    {
        $bdd =
           // new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8', 'b5a83bf957a94e', 'e7c157ba');
         new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
        $request = $bdd -> prepare("INSERT INTO event(title, author, date_time, description, image, image_type,category,sous_category, video) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $request -> execute(array($title, $author, $date_time, $description, $image_tmp_name, $image_type,$category, $sous_category, $video));
        $lastid = $bdd->lastInsertId();
        header("location:eventpage.php?id=" . $lastid);
        ///////////////TEST///////////////
        $lastid = $bdd ->lastInsertId();
        header("location:jepsen-brite/eventpage.php?id=".$lastid);

    }


    if (isset($_POST['image']) xor isset($_POST['video'])) {
        if ($image_type === $allowed_filetypes[0] and empty($video)) {
            $image_tmp_name = "data:image/jpg;base64," . base64_encode($image_tmp_name);
            send_data($title, $author, $date_time, $description, $image_tmp_name, $image_type, $category, $sous_category, $video);
        } else if ($image_type === $allowed_filetypes[1] and empty($video)) {
            $image_tmp_name = "data:image/jpeg;base64," . base64_encode($image_tmp_name);
            send_data($title, $author, $date_time, $description, $image_tmp_name, $image_type, $category, $sous_category, $video);
        } else if ($image_type === $allowed_filetypes[2] and empty($video)) {
            $image_tmp_name = "data:image/png;base64," . base64_encode($image_tmp_name);
            send_data($title, $author, $date_time, $description, $image_tmp_name, $image_type, $category, $sous_category, $video);
        } else if ($image_type === $allowed_filetypes[3] and empty($video)) {
            $image_tmp_name = "data:image/gif;base64," . base64_encode($image_tmp_name);
            send_data($title, $author, $date_time, $description, $image_tmp_name, $image_type, $category, $sous_category, $video);
        } else if (isset($_POST['video']) and empty($image_name)) {
            $video = preg_replace("#.*youtube\.com/watch\?v=#", "", $video);
            // $video = "<iframe width='640' height='360' src ='https://www.youtube.com/embed/" . $video . "' frameborder='0' allowfullscreen></iframe>";
            $video = '"https://www.youtube.com/embed/" . $video';
            send_data($title, $author, $date_time, $description, $image_tmp_name, $image_type, $category, $sous_category, $video);
        } else {
            echo 'Please enter a picture of ".jpg", ".jpeg", ".png" or ".gif" type.';
        }
    }
}
if($_POST['image'] = null and $_POST['video'] = null) {
    echo "Please enter a picture or a video";
}
?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Create Event</title>
    <?/*require './include/header.php';*/?>

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
            <input type="file" id="image" name="image" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="video" style="font-size: 110%;">Video link</label><br>
            <input type="text" id="vid" name="video" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="description" style="font-size: 110%;">Description</label>
            <input type="text" name="description" required class="form-control">
        </div>
        <div class="form-group">
            <label for="category" style="font-size: 110%;">category</label>
            <select name="category" class="form-control">
                <option value="party">party</option>
                <option value="concert">concert</option>
                <option value="meeting">meeting</option>
                <option value="festival">festival</option>
            </select>
        </div>
        <button type="submit" name="addevent" class="btn btn-primary">Add Event</button>
    </form>
</main>

</body>
</html>