<!DOCTYPE html>
<html style="position: relative; min-height: 100%;;">

<? var_dump($_SERVER["REQUEST_URI"]); ?>
	<head>
		<meta charset="utf-8" />
		<title>event page</title>
        <script src="https://cdn.tiny.cloud/1/rc3x3afwvdknm43392a1j88f52b56x77doamtd7xm0tgi7u5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed textpattern permanentpen powerpaste emoticons tinycomments tinymcespellchecker',
                toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen emoticons ',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                textpattern_patterns: [
                    {start: '*', end: '*', format: 'italic'},
                    {start: '**', end: '**', format: 'bold'},
                    {start: '#', format: 'h1'},
                    {start: '##', format: 'h2'},
                    {start: '###', format: 'h3'},
                    {start: '####', format: 'h4'},
                    {start: '#####', format: 'h5'},
                    {start: '######', format: 'h6'},
                    {start: '1. ', cmd: 'InsertOrderedList'},
                    {start: '* ', cmd: 'InsertUnorderedList'},
                    {start: '- ', cmd: 'InsertUnorderedList' }
                ]
            });
        </script>
	</head>
	<body>
		<main>

			<?php
            require "include/functions.php";
            require_once "include/bdb.php";
            require "include/header.php";
            include "include/Parsedown.php";
            if (isset($_POST["send"])) {
                $id = $_GET["id"];
                $Parsedown = new Parsedown();
                $message = $_POST["comment"];
                $Parsedown->line($message);
                $author = $_SESSION["auth"]->username;
                $date_time = date('Y-m-d H:i:s');
                //$bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
                $bdd = new PDO("mysql:host=localhost;dbname=jepsen-brite", "root", "");
                $request = $bdd->prepare("INSERT INTO comment(author,message,id_event,date_time)VALUE (?,?,?,?)");
                $request->execute(array($author, $message, $id, $date_time));
                $request->closeCursor();
            }

            $id = $_GET["id"];
            $bdd =
              //  new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
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
            $request->closeCursor();

            //////////////////////////////CATEGORY DISPLAY/////////////////////////////////
            $bdd = new PDO("mysql:host=localhost;dbname=jepsen-brite", "root", "");
            $cat_request = $bdd ->prepare("SELECT title FROM category where id=id");
            $cat_request ->execute(array($id));
            $category = $cat_request->fetch();
            if(isset($_SESSION['auth'])){
                $usersession = $_SESSION["auth"] -> username;
            }
            else{
                $usersession=null;
            }
            $cat_request->closeCursor();


            echo
					"<div class='card' style='width: 50%; margin: 0 auto 20px auto;'>";
					if(isset($data['image']) and empty($data['video'])){
					    echo "<img src='".$data['image']."' alt='Logo' class='card-img-top'>";
					}
					else if (isset($data['video']) and empty($data['image'])) {
					    echo "<iframe width='640' height='360' src ='https://www.youtube.com/embed/".$data['video']."' frameborder='0' allowfullscreen></iframe>";
                    }
						"<div class='card-body'>
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
								<span class='font-weight-bold'>Category :</span><br>".$category["title"]."
							</div>";
							if ($usersession === $test["author"] && $data["date_time"] > $actualdate){
								echo
								"<div>
									<a href='editevent.php?id=".$data["id"]."' class='card-link'>Edit this event</a>"
								;
							}

                    ?>

 "                   <div class='comment'>
                        <form action='eventpage.php?id=<?php echo $id; ?>' method='POST'>
                            <input type='hidden' name='id' value='<?php echo $id; ?>'>
                            <textarea name="comment" id="comment_editor" style="resize : none;" placeholder="Comments..."></textarea>
                            <!--<textarea name='comment' id="comment_editor" style="resize : none;"></textarea><br>-->
                            <input type='submit' value='Send comment' name="send">
                            <?
                            $display_comments = $bdd->prepare('SELECT * FROM comment where id_event=? ORDER BY date_time DESC ');
                            $display_comments ->execute(array($id));

                             while ($data_comment = $display_comments->fetch()){
                                 echo $data_comment['author']."<br>";
                                 echo $data_comment['message']."<br>";
                                 echo $data_comment['date_time']."<br>";

                             };

                            ?>
                        </form>
                    </div>

		</main>

	</body>
</html>

