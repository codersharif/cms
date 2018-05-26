<?php
  session_start();
    include("../database.php");
    include("session.php");
    include("alert_function.php");
  // logout option code::::::::::::::::::
  if (isset($_REQUEST['action'])){
    session_destroy();
    header("location:../index.php");
  }
  // unnonpersone access code:::::::::::::::::::::
  if (!isset($_SESSION['name'])) {
    die("Un aothorized access");
  }
  // insert function call code::::::::::::::::::::::::::::::::
    if(isset($_REQUEST['submit'])){
      extract($_REQUEST);
      $targate_path="img/";
      $targate_path=$targate_path.basename($_FILES['image']['name']);
      $move=move_uploaded_file($_FILES['image']['tmp_name'], $targate_path);
      $password=sha1($password);
      $cpassword=sha1($cpassword);
      
      if ($password == $cpassword){

          if ($connect->insert("users","name='$name',profile_pic='$targate_path', email='$email',password='$password',role='$role',status='$status'")){
           // $msg="<h3 class=\"success\">User Registration Success</h3>";
           $msg="User Registration Success";
           echo $alert_obj->alert($msg);
        }
             else{
            // $msg="<h3 class=\"delete\">User Registration Fail!</h3>";
               $msg="User Registration Fail!";
               echo $alert_obj->alert($msg);
          }
                  
       }
       else{
          $msg="Comfirm Password Don\'t Match";
          echo $alert_obj->alert($msg);
       }

  }

  // update query php code:::::::::::::
  if (isset($_REQUEST['update'])) {
     extract($_REQUEST);
     $targate_path="img/";
     $targate_path=$targate_path.basename($_FILES['image']['name']);
     $move=move_uploaded_file($_FILES['image']['tmp_name'], $targate_path);
     $oldpassword=sha1($oldpassword);
     $newpassword=sha1($newpassword);
     $cpassword=sha1($cpassword);

     $result=$connect->getByid("users","*","user_id='$edit_user'");
     $dbpassword=$result['password'];

     if ($oldpassword == $dbpassword){
        if ($newpassword == $cpassword){
          if($connect->update("users","name='$name',profile_pic='$targate_path',email='$email',password='$newpassword',role='$role',status='$status'","user_id='$edit_user'")){
         // $msg="<h3 class=\"success\">User Update Success</h3>";
           $msg="User update Success";
           echo $alert_obj->alert($msg);
        }
         else{
            // $msg="<h3 class=\"delete\">User Update Fail!</h3>";
           $msg="User update Fail!";
           echo $alert_obj->alert($msg);
         }
          
      }
      else{
        $msg="New password & Comfirm password Don\'t Match!";
        echo $alert_obj->alert($msg);
      }
       
     }
     else{
      $msg="Old Password is Wrong!";
      echo $alert_obj->alert($msg);
     }

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>admin</title>
    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
  </head>
  <body>
    <!-- nav::::::::::::::::::::::::::::::::: -->
    <?php
    include("dashboard_menus.php");
    // session call
       echo $obj->msg();
    ?>
        <div id="delete">
      <!-- delete option code:::::::::::::::::::::: -->
      <?php
        if (isset($_REQUEST['del_id'])) {
          $del_id=$_REQUEST['del_id'];

      ?>
         <p class="delete">Do you want to Delete&nbsp;<a class="btn small orange" href="users.php?cdel_id=<?=$del_id;?>">Yes</a>
         &nbsp;&nbsp;
         <a class="btn small orange" href="users.php">No</a></p>
      <?php
        }

        if (isset($_REQUEST['cdel_id'])) {
          $cdel_id=$_REQUEST['cdel_id'];

          // delete function call:::::::::::::::::
        if ($connect->delete("users","user_id='$cdel_id'")){
            $_SESSION['msg']="Delete Success.";
            header("location:users.php");
          }
          else{
            $_SESSION['msg']="Delete Fail!.";
          }

        }
      ?>
    </div>
    <div class="main">
      <h2 class="manage">Manage Users</h2>
      <!-- <?=@$msg; ?> -->

<!-- edit set value php code:::::::::::::::::::::::::: -->
  <?php
  if (isset($_REQUEST['edit_id'])){
    $edit_id=$_REQUEST['edit_id'];
    extract($connect->getByid("users","*","user_id='$edit_id'"));
  ?>

    
    <!-- <?=@$msg;?> -->
    <!-- menu edit from::::::::::::::::::::::: -->
    <h2 class="m_h">Edit Users</h2>
     <form action="users.php" method="post" enctype="multipart/form-data">
        <table border="1" align="center" cellpadding="5" class="tab_tr head">
         <tr>
          <p class="ptag">Do you update profile picture ? please select picture .</p>
          <th></th>
          <td>
           <?php echo '<img class=\'img\' height="80" width="80" src="'.$profile_pic.'">';?>
         </td>
         </tr>
          <tr>
            <th>Profile picture</th>
            <td><input type="file" name="image"></td>
          </tr>
          <tr>
            <th>Users name</th>
            <td><input type="text"  name="name" size="30" value="<?=$name?>"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><input type="text"  name="email" size="30" value="<?=$email?>"></td>
          </tr>
          <tr>
            <th>Old Password</th>
            <td><input type="password"  name="oldpassword" size="32" placeholder="*****"></td>
          </tr>
           <tr>
            <th>New Password</th>
            <td><input type="password"  name="newpassword" size="32" placeholder="*****"></td>
           </tr>
           <tr>
            <th>Comfirm Password</th>
            <td><input type="password"  name="cpassword" size="32" placeholder="*****"></td>
           </tr>
          <tr>
            <th>Role</th>
            <td>
              <select name="role">
                <option value="Admin" <?php echo $role=='Admin'?'selected':'';?>>Admin</option>
              </select>
            </td>
          </tr>
          <tr>
            <th>Status</th>
            <td>
              <select name="status">
                <option value="0" <?php echo $status==0?'selected':'';?>>unpublish</option>
                <option value="1" <?php echo $status==1?'selected':'';?>>publish</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <input type="hidden" name="edit_user" value="<?php echo $user_id;?>">
              <input type="submit" name="update" value="Update" class="btn orange">
            </td>
          </tr>
          
        </table>
      </form>
<?php
  }

  else{
?>
     <!-- menu insert form::::::::::::::::::::::::::::: -->
     <h2 class="m_h">Add a new user Registration</h2>
      <form action="users.php" method="post" enctype="multipart/form-data">
        <table border="1" align="center" cellpadding="5" class="tab_tr head">
          <tr>
            <th>Profile picture</th>
            <td><input type="file" name="image" size="30"></td>
          </tr>
          <tr>
            <th>Users name</th>
            <td><input type="text"  name="name" size="30"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td><input type="text"  name="email" size="30"></td>
          </tr>
          <tr>
            <th>Password</th>
            <td><input type="password"  name="password" size="31" placeholder="*******"></td>
          </tr>
           <tr>
            <th>Confirm Password</th>
            <td><input type="password"  name="cpassword" size="31" placeholder="*******"></td>
          </tr>
          <tr>
            <th>Role</th>
            <td>
              <select name="role">
                <option value="Admin">Admin</option>
              </select>
            </td>
          </tr>
          <tr>
            <th>Status</th>
            <td>
              <select name="status">
                <option value="0">unpublish</option>
                <option value="1">publish</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <input type="submit" name="submit" value="Save" class="btn orange">
            </td>
          </tr>
          
        </table>
      </form>
  <?php
   //edit else bracaket::::::::::::::::::::
      }
  ?>
    </div>

    <div style="margin-bottom: 15px;">
      <!-- edit delete option table::::::::::::: -->
      <table border="1" cellspacing="5" width="800" style="text-align: center;" class="action_size action_table">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
        $users=$connect->getall("users","*");
        if (is_array($users)){
        foreach ($users as $user){
        extract($user);
        
        ?>
        <tr>
          <td><?=$name;?></td>
          <td><?=$email;?></td>
          <td><?=$role;?></td>
          <td>
            <?php echo $status==1?"Publish":"Unpublish"; ?>
          </td>
          <td>
            <a class="btn small orange" href="users.php?edit_id=<?=$user_id;?>">Edit</a>&nbsp;&nbsp;&nbsp;
            <a class="btn small orange" href="users.php?del_id=<?=$user_id;?>">Delete</a>
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