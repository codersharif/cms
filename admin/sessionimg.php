<?php
    session_start();
    //make sure you have created the **upload** directory
    if (isset($_REQUEST['submit'])) {
    $filename= $_FILES["picture"]["tmp_name"];
    $destination = "img/" . $_FILES["picture"]["name"]; 
    move_uploaded_file($filename, $destination); //save uploaded picture in your directory
    $_SESSION['user_name6'] = $destination;
    header('Location: display.php');

    }
 
    ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 <form action="sessionimg.php" method="post" enctype="multipart/form-data">
  <label for="picture">Picture:</label>
  <input type="file" name="picture" id="picture"><br>
  <input type="submit" name="submit" value="Upload">
</form>

</body>
</html>