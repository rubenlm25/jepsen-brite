
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="css/app.css">

<?php require './include/functions.php' ?>
<?php require './include/header.php' ?>

<?php
if(!empty($_POST)){
    $errors = array();

    if(empty($_POST['username']) || !preg_match('/^[a-z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "your username/pseudo is not valid. ";
    }

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Please enter a valid email.";
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Please enter a valid password.";
    }


    debug($errors);
}

?>






<h1> Registration</h1>
<div class="container-fluid">
    <form  action="" method="POST">

    <div class="form-group">
        <label for="">Pseudo/ username</label>
        <input type="text" name="username" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" />
    </div>
    <div class="form-group">
        <label for="">confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" />
    </div>

        <button type="submit" class="btn btn-primary">Register</button>

</form>
    </div>
<?php require 'include/footer.php' ?>
