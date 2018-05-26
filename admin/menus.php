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
  // menus insert function call code::::::::::::::::::::::::::::::::
  if(isset($_REQUEST['submit'])){
    extract($_REQUEST);
    
  if($connect->insert("menus","name='$menu_name',content='$content',status='$status'")){
    // $msg="<h3 class=\"success\">Menu Add Success</h3>";
    $msg="Menu Add Success";
    echo $alert_obj->alert($msg);

  }
  else{
    // $msg="<h3 class=\"delete\">Menu Add Fail!</h3>";
    $msg="Menu Add Fail!";
    echo $alert_obj->alert($msg);
  }
  }

  // update query php code:::::::::::::
  if (isset($_REQUEST['update'])) {
     extract($_REQUEST);
     if($connect->update("menus","name='$menu_name',content='$content',status='$status'","menu_id='$edit_menu'")){
       // $msg="<h3 class=\"success\">Menu Update Success</h3>";
       $msg="Menu update Success";
       echo $alert_obj->alert($msg);
     }
     else{
         // $msg="<h3 class=\"delete\">Menu Update Fail!</h3>";
       $msg="Menu Update Fail!";
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
          <style>
        .no_data{
    margin-left: 15px;
    color: #666;
    border-bottom: 1px solid #666;
    }
    </style>
  </head>
  <body>
    <!-- nav::::::::::::::::::::::::::::::::: -->
    <?php
    include("dashboard_menus.php");
    ?>
    <?php
     echo $obj->msg();
    ?>
    <div id="delete">
      <!-- delete option code:::::::::::::::::::::: -->
      <?php
        if (isset($_REQUEST['del_id'])) {
          $del_id=$_REQUEST['del_id'];

      ?>
         <p class="delete">Do you want to Delete <a class="btn small orange" href="menus.php?cdel_id=<?=$del_id;?>">Yes</a>
         &nbsp;&nbsp;
         <a class="btn small orange" href="menus.php">No</a></p>
      <?php
        }

        if (isset($_REQUEST['cdel_id'])) {
          $cdel_id=$_REQUEST['cdel_id'];

          // delete function call:::::::::::::::::
        if ($connect->delete("menus","menu_id='$cdel_id'")){
            $_SESSION['msg']="Delete Success.";
            header("location:menus.php");
          }
          else{
            $_SESSION['msg']="Delete Fail!.";
          }

        }
      ?>
    </div>
    <!-- :::::::::::::main content:::::::::::: -->
    <div class="main">
      <h2 class="manage">Manage Menus</h2>
      <!-- <?=@$msg; ?> -->

<!-- edit set value php code:::::::::::::::::::::::::: -->
  <?php
  if (isset($_REQUEST['menu_id'])){
    $menu_id=$_REQUEST['menu_id'];
    extract($connect->getByid("menus","*","menu_id='$menu_id'"));
  ?>

    <h2 class="m_h">Edit Menu</h2>
    <!-- <?=@$msg;?> -->
    <!-- menu edit from::::::::::::::::::::::: -->
    <form action="menus.php" method="post">
        <table border="1" align="center" cellpadding="5" class="head">
          <tr>
            <th>Menu name</th>
            <td><input type="text" value="<?Php echo isset($name)?$name:'';?>" name="menu_name" size="30"></td>
          </tr>
          <tr>
            <th>Content</th>
            <td>
              <textarea name="content" id="content" cols="50" rows="5">
               <?Php echo isset($content)?$content:'';?>
              </textarea>
              <script>
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
              CKEDITOR.replace( 'content' );
              </script>
            </td>
          </tr>
          <tr>
            <th>Status</th>
            <td>
              <select name="status">
                <option value="0" <?php echo $status==0?'selected':''; ?>>unpublish</option>
                <option value="1" <?php echo $status==1?'selected':''; ?>>publish</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <input type="hidden" name="edit_menu" value="<?php echo $menu_id;?>">
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
      <h2 class="m_h">Add a new menu</h2>
      <form action="menus.php" method="post">
        <table border="1" align="center" cellpadding="5" class="head">
          <tr>
            <th>Menu name </th>
            <td><input type="text"  name="menu_name" size="30"></td>
          </tr>
          <tr>
            <th>Content </th>
            <td>
              <textarea name="content" id="content" cols="50" rows="5"></textarea>
              <script>
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
              CKEDITOR.replace( 'content' );
              </script>
            </td>
          </tr>
          <tr>
            <th>Status </th>
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
      <table border="1" cellspacing="5" width="500" style="text-align: center;" class="action_table">
        <tr>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
        $menus=$connect->getall("menus","*");
        if (is_array($menus)){
        foreach ($menus as $menu){
        extract($menu);
        
        ?>
        <tr>
          <td><?=$name;?></td>
          <td>
            <?php echo $status==1?"Publish":"Unpublish"; ?>
          </td>
          <td>
            <a class="btn small orange" href="menus.php?menu_id=<?=$menu_id;?>">Edit</a>&nbsp;
            <a class="btn small orange" href="menus.php?del_id=<?=$menu_id;?>">Delete</a>
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