
<html>
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
                $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
                // ("mysql:host=localhost;dbname=jepsen-brite","root","root");
                $request =$bdd->prepare("SELECT * FROM event WHERE category = ? ");
                $request ->execute(array($choice));
                while($data = $request->fetch()){
                    echo "<p>titre : ".$data["title"]."</p>";
                    }
                }
            ?>

        </main>
    </body>
</html>
