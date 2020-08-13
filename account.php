

<?php
session_start();
require_once './include/functions.php';
require_once './include/bdb.php';


logged_only();

//if (!empty($_POST['avatar']))
//debug($_SESSION);

$email_profile = $_SESSION['auth']->email;
$default = "";
$size = 100;

$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email_profile)  ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

 ?>




<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php require './include/header.php';?>

</head>
<br><br>
<body>

<div class="container">



    <div class="container bg-dark " align = "center" style="border: transparent;border-radius: 20px 20px;padding-top: 15px; max-width: 750px;">
        <img src="<?php echo $grav_url; ?>" alt="gravatar_picture" style="padding-top: 5px;"/>
        <h2 style="color: #f5deb3;">HELLO ! </h2><h1 style="color: whitesmoke"> <?= $_SESSION['auth']->username; ?></h1><h2 style="color: wheat;"> Welcome to Jepsen-Brite!</h2>

    </div><br><br><br>
    <br>
    <div class="container" align = "center">
        <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModalLong1">
            Events created
        </button>

        <!-- Modal -->
        <div class="modal fade  " id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Your events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div style="width: 100px; height: 150px;">

                        </div>
<?php

                        require_once './include/functions.php';
                        require_once './include/bdb.php';
                        $user_event = $_SESSION['auth']->username;
                        $request = $pdo->prepare("SELECT * FROM event where author=?");
                        $request->execute(array($user_event));
                        while ($data = $request->fetch()) {
?>
                            <b>DATE: <span></span><?= $data->date_time; ?></b><br>
                            <b>TITLE: <span></span><?= $data->title; ?></b><br>
                            <b>AUTHOR: <span></span><?= $data->author; ?></b><br>
                            <b>DESCRIPTION: <span></span><?= $data->description; ?></b><br>
                            <b>STYLE: <span></span><?= $data->category; ?></b><br>
                            <b>MUSIQUE: <span></span><?= $data->sous_category; ?></b><br>

                            <div> <img src="<?=$data->image ?>" alt="image" style="width: 100px; height: 100px;"></div>
                            <hr/>


<?php

                        }
                        ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModalLong2">
            Events you participated to
        </button>

        <div class="modal fade bd-example-modal-lg " id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Your Past events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div style="width: 100px; height: 150px;">

                        </div>


                        <?Php
                                require_once './include/functions.php';
                                require_once './include/bdb.php';
                                $user_event_participe = $_SESSION['auth']->id;
                                //debug($_SESSION['auth']);


                                $request = $pdo->prepare("SELECT * FROM participe where user_id=?");
                                $request->execute(array($user_event_participe));
                                $date_courante = new DateTime();

                                while( $data=$request->fetch()) {
                                $event_id = $data->event_id;
                                $table = $pdo->prepare('SELECT * FROM event WHERE id=? AND date_time < CURRENT_DATE ');
                                $table->execute(array($event_id));
                                $result = $table->fetchAll();


                               // debug( $result);
                                   // echo "<pre>";
                                   // print_r($result);
                                    foreach ($result as $res){
                                        ?>
                                        <b>DATE: <span></span><?= $res->date_time; ?></b><br>
                                        <b>TITLE: <span></span><?= $res->title; ?></b><br>
                                        <b>AUTHOR: <span></span><?= $res->author; ?></b><br>
                                        <b>DESCRIPTION: <span></span><?= $res->description; ?></b><br>
                                        <b>STYLE: <span></span><?= $res->category; ?></b><br>
                                        <b>MUSIQUE: <span></span><?= $res->sous_category; ?></b><br>

                                        <div> <img src="<?=$data->image ?>" alt="image" style="width: 100px; height: 100px;"></div>
                                        <hr/>


                                        <?php

                                    }

                                }



                                ?>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#exampleModalLong3">
            Events you will participate
        </button>

        <div class="modal fade bd-example-modal-lg " id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Your futur Events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
<?php
                       // require_once './include/functions.php';
                      //  require_once './include/bdb.php';
                       // $user_event_participe = $_SESSION['auth']->id;
                        //debug($_SESSION['auth']);


                     //   $request = $pdo->prepare("SELECT * FROM participe where user_id=?");
                      //  $request->execute(array($user_event_participe));
                     //   $date_courante = new DateTime();
                     //   while( $data= $request->fetch()) {
                         //   $event_id = $data->event_id;
                         //   $table = $pdo->prepare('SELECT * FROM event WHERE id=?');
                          //  $table->execute(array($event_id));
                          //  while ($result = $table->fetch()) {
                               // $date = $result->date_time;

                              //  if ($date_courante > $date) {

                                  //  echo $result->date_time;
                              //  }
                           // }
                       // }


                       // echo" salut";
                       // ?>



                        <?Php
                        require_once './include/functions.php';
                        require_once './include/bdb.php';
                        $user_event_participe = $_SESSION['auth']->id;
                        //debug($_SESSION['auth']);


                        $request = $pdo->prepare("SELECT * FROM participe where user_id=?");
                        $request->execute(array($user_event_participe));
                        $date_courante = new DateTime();

                        while( $data=$request->fetch()) {
                            $event_id = $data->event_id;
                            $table = $pdo->prepare('SELECT * FROM event WHERE id=? AND date_time > CURRENT_DATE ');
                            $table->execute(array($event_id));
                            $result = $table->fetchAll();


                            // debug( $result);
                            // echo "<pre>";
                            // print_r($result);
                            foreach ($result as $res){
                                ?>
                                <b>DATE: <span></span><?= $res->date_time; ?></b><br>
                                <b>TITLE: <span></span><?= $res->title; ?></b><br>
                                <b>AUTHOR: <span></span><?= $res->author; ?></b><br>
                                <b>DESCRIPTION: <span></span><?= $res->description; ?></b><br>
                                <b>STYLE: <span></span><?= $res->category; ?></b><br>
                                <b>MUSIQUE: <span></span><?= $res->sous_category; ?></b><br>


                                <div> <img src="<?=$res->image ?>" alt="image" style="width: 100px; height: 100px;"></div>
                                <hr/>


                                <?php

                            }

                        }



                        ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div><br><br>
    <h3 style="color: wheat;padding: 5px; " >User informations</h3>
    <h4 style="color: navajowhite;"> Your Pseudo :    <?= $_SESSION['auth']->username; ?></h4>
    <h4 style="color: navajowhite;">Your Email : <?= $_SESSION['auth']->email; ?></h4><br><br><br>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
