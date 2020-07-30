<html>
    <head>
        <meta charset="utf-8" />
        <title>event page</title>
    </head>
    <body>
        <main>
            <?php
                $id = $_GET["id"];
                $bdd =
                    // new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
                    new PDO("mysql:host=localhost;dbname=jepsen-brite","root","");
                $request = $bdd ->prepare("SELECT * FROM event where id=?");
                $request ->execute(array($id));
                $data = $request->fetch();

                echo "<img src='".$data['image']."' alt='Logo'><br>"
                    ."<span> Title <br>".$data["title"]."<br></span>"
                    ."<span> event date<br>".$data["date_time"]. "<br></span>"
                    ."<span> descritpion <br>".$data["description"]."<br></span>"
                    ."<span> category <br>".$data["category"]."<br></span>"
                    ."<a href='editevent.php?id=".$data["id"]."'>edit </a>";

            ?>
        </main>
    </body>
</html>