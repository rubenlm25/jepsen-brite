<?php
if(isset($_POST['submit'])){
    $fileAvatar = $_FILES['avatar'];
    $fileName = $fileAvatar['name'];
    $fileSize = $fileAvatar['size'];
    $fileTmplocat = $fileAvatar['tmp_name'];
   $fileError = $fileAvatar['error'];
    print_r($f)
    // allowed only extensions
    $f = explode('.',$fileName);
    $fileExtensions = strtolower($f[1]);

    $allowedExt = array('jpg','jpeg','png');
    if()

}

?>


<form action="fileUpload.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlFile1">Avatar : </label>
        <input type="file" name="avatar"   class="form-control" ><br>
        <input type="submit" name="submit" value="Upload the file" class="btn btn-primary">
    </div>
</form >
