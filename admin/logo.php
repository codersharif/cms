<?php
  session_start();
    include("../database.php");
    include("session.php");
    // include("alert_function.php");
  // logout option code::::::::::::::::::
  if (isset($_REQUEST['action'])){
    session_destroy();
    header("location:../index.php");
  }
  // unnonpersone access code:::::::::::::::::::::
  if (!isset($_SESSION['name'])) {
    die("Un aothorized access");
  }

  // img  insert function call code::::::::::::::::::::::::::::::::
  if (isset($_REQUEST['submit'])){
    $targate_path="img/";
    $targate_path=$targate_path.basename($_FILES['image']['name']);
    // $move=move_uploaded_file($_FILES['image']['tmp_name'],$targate_path);
    if (move_uploaded_file($_FILES['image']['tmp_name'],$targate_path) !=false){
       $connect->insert("logo","image='$targate_path'");
       $msg="<h3 class=\"success\">Image Upload Success</h3>";
    }
      
   
  }

  // 2nd option img insert
/*if (isset($_REQUEST['submit'])){
   if (getimagesize($_FILES['image']['tmp_name']) == FALSE){
       echo "Please select a image!";
   }
   else{
      $image=addslashes($_FILES['image']['tmp_name']);
      $name=addslashes($_FILES['image']['name']);
      $image=file_get_contents($image);
      $image=base64_encode($image);
      $connect->insert("logo","name='$name',image='$image'");
       $msg="<h3 class=\"success\">Image Upload Success</h3>";

   }
  
}*/

  // update query php code:::::::::::::

?>

<!DOCTYPE html>
<html>
  <head>
    <title>admin</title>
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
       <style>
        .no_data{
    margin-left: 15px;
    margin-right: 15px;
    color: #666;
    border-bottom: 1px solid #666;
    }
    </style>
  </head>
  <body>
    <!-- nav::::::::::::::::::::::::::::::::: -->
    <?php
    include("dashboard_menus.php");
    echo $obj->msg();
    ?>

    <div id="delete">
      <!-- delete option code:::::::::::::::::::::: -->
      <?php
        if (isset($_REQUEST['del_id'])) {
          $del_id=$_REQUEST['del_id'];

      ?>
         <p class="delete">Do you want to Delete&nbsp;<a class="btn small orange" href="logo.php?cdel_id=<?=$del_id;?>">Yes</a>
         &nbsp;&nbsp;
         <a class="btn small orange" href="logo.php">No</a></p>
      <?php
        }

        if (isset($_REQUEST['cdel_id'])) {
          $cdel_id=$_REQUEST['cdel_id'];

          // delete function call:::::::::::::::::
        if ($connect->delete("logo","logo_id='$cdel_id'")){
            $_SESSION['msg']="Delete Success.";
            header("location:logo.php");
          }
          else{
             $_SESSION['msg']="Delete Fail!.";
          }

        }
      ?>
    </div>
    <div class="main">
      <h2 class="manage">Manage Logo</h2>
      <?=@$msg; ?>

<!-- edit set value php code:::::::::::::::::::::::::: -->
 
     <!-- menu insert form::::::::::::::::::::::::::::: -->
      <h2 class="m_h">Add a new logo</h2>
      <form action="logo.php" method="post" enctype="multipart/form-data">
        <table border="1" align="center" cellpadding="5" class="tab_tr head">
          <br>
          <tr>
            <th>Logo upload</th>
            <td><input type="file"  name="image" size="30"></td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <input type="submit" name="submit" value="Save" class="btn orange">
            </td>
          </tr>
          
        </table>
      </form>
    </div>
    <!-- sidebar:::::::::::::::::::::: -->
   <!--  <div class="sidebar">
     <table border="1" cellpadding="5" align="center" width="400">
       <tr>
         <th>Now upload logo</th>
       </tr>
       <tr>
         <td align="center">LOGO</td>
         <td align="center">LOGO</td>
         <td align="center">LOGO</td>
         <td></td>
       </tr>
       
     </table>
      </div> -->

    <div style="margin-bottom: 15px; margin-left: 25px;">
      <!-- edit delete option table::::::::::::: -->
      <h2 class="m_h">Now upload logo</h2>
      <table border="1" cellpadding="5" align="center" width="600" class="action_table action_size">
        <tr>
          <th>Sl</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        <?php
        $logo=$connect->select_orderBy_desc("logo","*","logo_id");
        if(is_array($logo)){
    
        foreach ($logo as $logovalue){
        extract($logovalue);
        
        ?>
           <tr>
            <td >ID:<?=$logo_id?></td>
          <td align="center"><?php echo '<img height="80" width="80" src="'.$image.'">';?>
           
              <form action="update_logo.php" method="post" enctype="multipart/form-data">
              <br>
              Update image:<input type="file" name="image">
                <input type="hidden" name="e_id" value="<?php echo $logovalue['logo_id'];?>">
                <input class="btn small orange" type="submit" name="update" value="Update">
              </form>
          
          </td>
          <td align="center">
            <a class="btn small orange" href="logo.php?del_id=<?=$logo_id;?>">Delete</a>
          </td>
        </tr>
  
        <?php
        }
      }
      else{
         echo "<h3 class=\"no_data\">NO DATA......</h3>";
      }

        ?>
      </table>
    </div>
  </body>
</html>