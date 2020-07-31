<?php
    $id =$_GET["id"];
    $message=$_POST["comment"];
    $author=$_SESSION["auth"]->username;
    $date_time = date('Y-m-d H:i:s');
    $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
$request = $bdd -> prepare("INSERT INTO comment(author,message,id_event,date_time)VALUE (?,?,?,?)");
$request ->execute(array($author,$message,$id,$date_time));
header("location=eventpage.php?id=".$id);

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>event page</title>
    </head>
    <body>
        <main>
            <?php
            require "include/functions.php";
            require_once "include/bdb.php";
            require "include/header.php";
                $id = $_GET["id"];
                $bdd =
                    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
                    // new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
                $request = $bdd ->prepare("SELECT * FROM event where id=?");
                $request ->execute(array($id));
                $data = $request->fetch();
                $usersession = $_SESSION["auth"] -> username;
                $auth = $bdd -> prepare("SELECT author FROM event WHERE id=?");
	            $auth -> execute(array($id));
                $test = $auth->fetch();
                $actualdate = date('Y-m-d H:i:s');
            

                echo "<img src='".$data['image']."' alt='Logo'><br>"
                    ."<span> Title <br>".$data["title"]."<br></span>"
                    ."<span> event date<br>".$data["date_time"]. "<br></span>"
                    ."<span> descritpion <br>".$data["description"]."<br></span>"
                    ."<span> category <br>".$data["category"]."<br></span>";
                    if ($usersession === $test["author"] && $data["date_time"] > $actualdate){
                        echo "<a href='editevent.php?id=".$data["id"]."'>edit </a>";
                    }
		if(isset($_SESSION["auth"])){
                        echo "<form action='eventpage.php?id=".$id."' method='post'>
                                <textarea name='comment' cols='50'>write a comment</textarea>
                                <input type='submit' value='send'>
                              </form>";
                    }
                    $displaycomment=$bdd->prepare("SELECT * FROM comment WHERE id_event=? ORDER BY date_time");
                    $displaycomment->execute(array($id));
                    while($comment=$displaycomment->fetch()){
                        echo "<div>
                                    <p>".$comment["author"]."</p>
                                    <p>".$comment["date_time"]."</p>
                                    <p>.".$comment["message"]."</p>
                              </div>";
                    }
                    

            ?>
        </main>
    </body>
</html>
