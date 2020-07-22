
<html>
<body>
<?php require './include/header.php' ?>
<?php require './include/functions.php' ?>

<!-- verification formulaire -->
<?php
if(!empty($_POST))
{
    $errors = array();
    require_once './include/bdb.php';



    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']))
    {
        $errors['username'] = "your username/pseudo is not valid. ";
    } else {
        $requete = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $requete->execute([$_POST['username']]);
        $user =$requete->fetch();
        if($user){
            $errors['username'] = 'This pseudo already used please enter a new one!';
        }
    }



    if(empty($_POST['email']) ||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = "Please enter a valid email.";
    } else {
        $requete = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $requete->execute([$_POST['email']]);
        $user = $requete->fetch();
        if ($user) {
            $errors['email'] = 'This email is already used please enter a new one!';
        }
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'])
    {
        $errors['password'] = "Please enter the same password.";
    }

    if(empty($errors))
    {

        $requete = $pdo-> prepare("INSERT INTO users SET username = ?, password = ?, email = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT );


        $requete->execute([$_POST['username'], $password, $_POST['email']]);
        die('account created !');

    }
    debug($errors);





}
?>




<head>
    <h1> Registration</h1>
</head>



<?php if(!empty($errors)): ?>
<div class="alert alert-danger">
    <p>You did not fill the form correctly</p>
    <?php foreach($errors as $error): ?>
        <ul>
            <li><?= $error; ?></li>
        </ul>
    <? endforeach; ?>
</div>
<?php endif; ?>

    <form  action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="">Pseudo/ username : </label>
        <input type="text" name="username" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">Email : </label>
        <input type="text" name="email" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">Password : </label>
        <input type="password" name="password" class="form-control" />
    </div>

    <div class="form-group">
        <label for="">confirm Password : </label>
        <input type="password" name="password_confirm" class="form-control" />
    </div>

        <div class="form-group">
            <label for="exampleFormControlFile1">Avatar : </label>
            <input type="file" name="avatar"   class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary">Register</button>

</form>


<?php require 'include/footer.php' ?>
</body>
</html>
