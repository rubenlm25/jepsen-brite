<?php
    if (isset($_POST["editevent"])){
        $id = $_POST["id"];
        $title = $_POST["title"];
        $date_time = $_POST["date_time"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $image = $_FILES['image']['name'];
        $bdd = new PDO("mysql:host=localhost;dbname=jepsen-brite","root","root");
        if(empty($image)) {
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
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>edit event</title>
</head>
<body>
<main>
    <h1>Edit Event</h1>
    <?php
    $id = $_GET["id"];
    $bdd = new PDO("mysql:host=localhost;dbname=jepsen-brite","root","root");
    $request = $bdd ->prepare("SELECT * FROM event where id=?");
    $request ->execute(array($id));
    $data = $request->fetch();
    $date_time_default= $data["date_time"];
    $date_time_default = date('Y-m-d\TH:i:s',strtotime($date_time_default));
    echo "<form  method=\"post\" action=\"editevent.php?id=".$id."\" enctype=\"multipart/form-data\">
        <input type='text' name='id' value='".$id."'>
        <div>
            <label for=\"title\">Title</label>
            <input type=\"text\" name=\"title\" required value='".$data["title"]."'>
        </div>
        <div>
            <label for=\"date_time\">Date and Time</label>
            <input type=\"datetime-local\" name=\"date_time\" value='".$date_time_default."'>
        </div>
        <div>
            <label for=\"image\">Image</label>
            <input type=\"file\" name=\"image\">
            <img src='".$data["image"]."'>
        </div>
        <div>
            <label for=\"description\">Description</label>
            <input type=\"text\" name=\"description\" value='".$data["description"]."'>
        </div>";
        if($data["category"] == "party"){
            echo "<div>
            <label for=\"category\">category</label>
            <select name=\"category\">
                <option value=\"party\"selected='selected'>party</option>
                <option value=\"concert\">concert</option>
                <option value=\"meeting\">meeting</option>
                <option value=\"festival\">festival</option>
            </select>
        </div>";
        }
        if ($data["category"] == "concert"){
            echo "<div>
            <label for=\"category\">category</label>
            <select name=\"category\">
                <option value=\"party\">party</option>
                <option value=\"concert\"selected='selected'>concert</option>
                <option value=\"meeting\">meeting</option>
                <option value=\"festival\">festival</option>
            </select>
        </div>";
        }
        if ($data["category"] == "meeting"){
            echo "<div>
            <label for=\"category\">category</label>
            <select name=\"category\">
                <option value=\"party\">party</option>
                <option value=\"concert\">concert</option>
                <option value=\"meeting\"selected='selected'>meeting</option>
                <option value=\"festival\">festival</option>
            </select>
        </div>";
        }
        if ($data["category"] == "festival"){
            echo "<div>
            <label for=\"category\">category</label>
            <select name=\"category\">
                <option value=\"party\">party</option>
                <option value=\"concert\">concert</option>
                <option value=\"meeting\">meeting</option>
                <option value=\"festival\"selected='selected'>festival</option>
            </select>
        </div>";
        }
    ?>
        <button type="submit" name="editevent">Edit Event</button>
    </form>



</main>
</body>
</html>
