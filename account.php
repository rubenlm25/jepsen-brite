

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



    <div class="container" align = "center">
        <h2 style="color: indianred;">HELLO ! </h2><h1> <?= $_SESSION['auth']->username; ?></h1><h2 style="color: indianred;"> Welcome to Jepsen-Brite!</h2>
    </div><br><br><br>
    <img src="<?php echo $grav_url; ?>" alt="" /><br><br><br><br>
    <div class="container" align = "center">
        <button type="button" class="btn btn-outline-primary btn-lg" data-toggle="modal" data-target="#exampleModalLong">
            Events created
        </button>

        <!-- Modal -->
        <div class="modal fade  " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Your events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times</span>
                        </button>
                    </div>
                    <div class="modal-body">
<?php

                        require_once './include/functions.php';
                        require './include/bdb.php';
                        $user_event = $_SESSION['auth']->username;
                        $request = $pdo->prepare("SELECT * FROM event where author=?");
                        $request->execute(array($user_event));
                        while ($data = $request->fetch()) {
?>
                            <b>DATE: <span></span><?= $data->date_time; ?></b><br>
                            <b>TITLE: <span></span><?= $data->title; ?></b><br>
                            <b>AUTHOR: <span></span><?= $data->author; ?></b><br>
                            <b>DESCRIPTION: <span></span><?= $data->description; ?></b><br>
                            <b>DESCRIPTION: <span></span><?= $data->category; ?></b><br>
                            <b>DESCRIPTION: <span></span><?= $data->sous_category; ?></b><br>

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

        <button type="button" class="btn btn-outline-secondary btn-lg" data-toggle="modal" data-target="#exampleModalLong">
            Events you participated to
        </button>

        <div class="modal fade bd-example-modal-lg " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Your Past events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-outline-warning btn-lg" data-toggle="modal" data-target="#exampleModalLong">
            Events you will participate
        </button>

        <div class="modal fade bd-example-modal-lg " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Your futur Events</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>User informations</h3><br>
    <h4> Your Pseudo :    <?= $_SESSION['auth']->username; ?></h4>
    <h4>Your Email : <?= $_SESSION['auth']->email; ?></h4><br><br><br>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
