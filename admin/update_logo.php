<?php
  session_start();
    include("../database.php");
  // logout option code::::::::::::::::::
  if (isset($_REQUEST['action'])){
    session_destroy();
      header("location:../index.php");
  }
  // unnonpersone access code:::::::::::::::::::::
  if (!isset($_SESSION['name'])) {
    die("Un aothorized access");
  }

  // img  update function call code::::::::::::::::::::::::::::::::
 // 1st option
  if (isset($_REQUEST['update'])){
     extract($_REQUEST);
     $targate_path="img/";
     $targate_path=$targate_path.basename($_FILES['image']['name']);
     $move=move_uploaded_file($_FILES['image']['tmp_name'],$targate_path);
     if ($move){
      $connect->update("logo","image='$targate_path'","logo_id='$e_id'");
      header("location:logo.php");
     }
     else{
      echo "fail!";
     }
  }
  // 2nd option
/*if (isset($_REQUEST['update'])){

      $image=addslashes($_FILES['image']['tmp_name']);
      $name=addslashes($_FILES['image']['name']);
      $image=file_get_contents($image);
      $image=base64_encode($image);
      $e_id=$_REQUEST['e_id'];
      $connect->update("logo","name='$name',image='$image'","logo_id='$e_id'");
      header("location:logo.php");
  
}
*/
  // update query php code:::::::::::::

?>
