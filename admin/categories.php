<?php
session_start();
include("../database.php");
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

if($connect->insert("categories","name='$cat_name',cat_status='$status'")){
  // $msg="<h3 class=\"success\">Category Add Success</h3>";
    $msg="Category Add success.";
    echo $alert_obj->alert($msg);
}
else{

// $msg="<h3 class=\"delete\">Category Add Fail!</h3>";
     $msg="Category Add Fail!";
     echo $alert_obj->alert($msg);
}
}
// update query php code:::::::::::::
if (isset($_REQUEST['update'])) {
extract($_REQUEST);
if($connect->update("categories","name='$cat_name',cat_status='$status'","cat_id='$edit_cat'")){
   // $msg="<h3 class=\"success\">Category Update Success</h3>";
        $msg="Category Update success.";
        echo $alert_obj->alert($msg);
}
else{
// $msg="<h3 class=\"delete\">Category Update Fail!</h3>";
     $msg="Category Update Fail!";
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
    
    <style>
        .no_data{
    margin-left: 15px;
    color: #666;
    border-bottom: 1px solid #666;
    }
    </style>
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
  </head>
  <body>
    <!-- nav::::::::::::::::::::::::::::::::: -->
    <?php
    include("dashboard_menus.php");
    include("session.php");
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
       <p class="delete">Do you want to Delete <a class="btn small orange" href="categories.php?ccat_id=<?=$del_id;?>">Yes</a>
      &nbsp;&nbsp;
      <a class="btn small orange" href="categories.php">No</a></p>
      <?php
      }
      if (isset($_REQUEST['ccat_id'])) {
      $ccat_id=$_REQUEST['ccat_id'];
      // delete function call:::::::::::::::::
      if ($connect->delete("categories","cat_id='$ccat_id'")){
        $_SESSION['msg']="Category Delete Success.";
        header("location:categories.php");
      }
      else{
       $_SESSION['msg']="Delete Fail!.";
      }
      }
      ?>
    </div>
    <div class="main">
      <h2 class="manage">Manage Categories</h2>
      <!-- <?=@$msg; ?> -->
      <!-- edit set value php code:::::::::::::::::::::::::: -->
      <?php
      if (isset($_REQUEST['cat_id'])){
      $cat_id=$_REQUEST['cat_id'];
      extract($connect->getByid("categories","*","cat_id='$cat_id'"));
      ?>
      <h2 class="m_h">Edit Menu</h2>
      <!-- <?=@$msg;?> -->
      <!-- menu edit from::::::::::::::::::::::: -->
      <form action="categories.php" method="post">
        <table border="1" align="center" cellpadding="5" class="tab_tr head">
          <tr>
            <th>Category name</th>
            <td><input type="text" value="<?Php echo isset($name)?$name:'';?>" name="cat_name" size="30"></td>
          </tr>
          <tr>
            <th>Status</th>
            <td>
              <select name="status">
                <option value="0" <?php echo $cat_status==0?'selected':''; ?>>unpublish</option>
                <option value="1" <?php echo $cat_status==1?'selected':''; ?>>publish</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <input type="hidden" name="edit_cat" value="<?php echo $cat_id;?>">
              <input type="submit" name="update" value="Update" class="btn orange mr_t">
            </td>
          </tr>
          
        </table>
      </form>
      <?php
      }
      else{
      ?>
      <!-- menu insert form::::::::::::::::::::::::::::: -->
      <h2 class="m_h">Add a new Categories</h2>
      <form action="categories.php" method="post">
        <table border="1" align="center" cellpadding="5" class="tab_tr head">
          <tr >
            <th>Category name</th>
            <td><input type="text"  name="cat_name" size="30"></td>
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
              <input type="submit" name="submit" value="Save" class="btn orange mr_t">
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
        $categories=$connect->getall("categories","*");
        if (is_array($categories)){
        foreach ($categories as $Category){
        extract($Category);
        
        ?>
        <tr>
          <td><?=$name;?></td>
          <td>
            <?php echo $cat_status==1?"Publish":"Unpublish"; ?>
          </td>
          <td>
            <a class="btn small orange" href="categories.php?cat_id=<?=$cat_id;?>">Edit</a>&nbsp;
            <a class="btn small orange" href="categories.php?del_id=<?=$cat_id;?>">Delete</a>
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