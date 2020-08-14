
<?php
$bdd =
    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
   // new PDO("mysql:host=localhost;dbname=jepsen-brite","root","root");
$id = $_GET["id"];

    if(isset($_POST["participate"])){
        $actionparticipate = $bdd ->prepare("INSERT INTO participate (event_id,user_id) VALUE (?,?)");
        $actionparticipate->execute(array($id,$_SESSION["auth"]->id));
    }
    if(isset($_POST["unparticipe"])){
    $actionparticipate = $bdd ->prepare("DELETE FROM participate WHERE event_id = ? AND user_id = ?");
    $actionparticipate->execute(array($id,$_SESSION["auth"]->id));
}

?>
<html style="position: relative; min-height: 100%;;">
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
            <?
            require_once "include/functions.php";
            require_once "include/bdb.php";
            require "include/header.php";
            include "./include/Parsedown.php";
            if (isset($_POST["send"])) {
            $id = $_GET["id"];
            $Parsedown = new Parsedown();
            $message = $_POST["comment"];
            $Parsedown->line($message);
            $author = $_SESSION["auth"]->username;
            $date_time = date('Y-m-d H:i:s');
            $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
            //$bdd = new PDO("mysql:host=localhost;dbname=jepsen-brite", "root", "root");
            $request = $bdd->prepare("INSERT INTO comment(author,message,id_event,date_time)VALUE (?,?,?,?)");
            $request->execute(array($author, $message, $id, $date_time));
            $request->closeCursor();
            }?>
			<?php


				$request = $bdd ->prepare("SELECT * FROM event where id=?");
				$request ->execute(array($id));
				$data = $request->fetch();
				if(isset($_SESSION['auth'])){
				    $usersession = $_SESSION["auth"] -> username;
				    $userid = $_SESSION["auth"] -> id;
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
								<span class='font-weight-bold'>address :</span><br>".$data["address"]."
							</div>
							<div class='card-text'>
								<span class='font-weight-bold'>postal code :</span><br>".$data["postal_code"]."
							</div>
							<div class='card-text'>
								<span class='font-weight-bold'>city :</span><br>".$data["city"]."
							</div>
							<div class='card-text'>
								<span class='font-weight-bold'>Category :</span><br>".$data["category"]."
							</div>
							<div class='card-text'>
							    <span class='font-weight-bold'>sous-Category :</span><br>".$data["sous_category"]."
							</div>
							<div class='card-text'>
								<span class='font-weight-bold'>map :</span><br>";
				$address = str_replace(" ","+",$data["address"]);
				?>
            <iframe src="https://www.google.com/maps?q=<?echo $address.",+".$data["postal_code"]."+".$data["city"];?>&output=embed" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
tabindex="0"></iframe>
<?php
				    echo "</div>
							";

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

                <?php
                if(isset($_SESSION["auth"])){
                    $participate = $bdd ->prepare("SELECT * FROM participe WHERE event_id = ? AND user_id =? ");
                    $participate ->execute(array($id,$userid));
                    $dataparticipate = $participate->fetch();
                    debug($dataparticipate);
                    if (empty($dataparticipate)){
                        ?>
            <a href="participe-post.php?id=<?=$id ?>&action=yes">participe</a>
                    <?
                    }
                    else{
                        ?>
                    <a href="participe-post.php?id=<?=$id ?>&action=no">unparticipe</a>
                <?
                    }
                }

            ?>
            <div class='comment'>
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
