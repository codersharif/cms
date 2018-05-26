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
  // articles insert function call code::::::::::::::::::::::::::::::::
     if (isset($_REQUEST['submit'])){
      extract($_REQUEST);
      $targate_path="img/";
      $targate_path=$targate_path.basename($_FILES['image']['name']);
    // $move=move_uploaded_file($_FILES['image']['tmp_name'],$targate_path);
    if (move_uploaded_file($_FILES['image']['tmp_name'],$targate_path) !=false){
         $connect->insert("articles","title='$title',image='$targate_path',cat_id='$cat_id',content='$content',status='$status'");
       // $msg="<h3 class=\"success\">Article Add Success.</h3>";
          $msg="article Add success.";
          echo $alert_obj->alert($msg);
    }
    else{
       $msg="article Add Fail!";
       echo $alert_obj->alert($msg);
    }
      
   
  }

  // 2nd option code
    
/*  if(isset($_REQUEST['submit'])){
    if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
       $msg="Please select agin image !";
    }
    else{
      $image=addslashes($_FILES['image']['tmp_name']);
      $name=addslashes($_FILES['image']['name']);
      $image=file_get_contents($image);
      $image=base64_encode($image);
      $title=$_REQUEST['title'];
      $cat_id=$_REQUEST['cat_id'];
      $content=$_REQUEST['content'];
      $status=$_REQUEST['status'];
      $connect->insert("articles","title='$title',img_name='$name',image='$image',cat_id='$cat_id',content='$content',status='$status'");
      
      $msg="<h3 class=\"success\">Article Add Success</h3>";
    }
  }*/

  // update query php code:::::::::::::
  // 1st option
    if (isset($_REQUEST['update'])){
     extract($_REQUEST);
     $targate_path="img/";
     $targate_path=$targate_path.basename($_FILES['image']['name']);
     $move=move_uploaded_file($_FILES['image']['tmp_name'],$targate_path);
     if ($move){
      $connect->update("articles","title='$title',image='$targate_path',cat_id='$cat_id',content='$content',status='$status'","art_id='$edit_art'");
         // $msg="<h3 class=\"success\">Article Update Success</h3>";
          $msg="article Update success.";
          echo $alert_obj->alert($msg);
       
     }
     else{
        // $msg="<h3 class=\"delete\">Article Update Fail!</h3>";
         $msg="article Update Fail!";
          echo $alert_obj->alert($msg);

     }
  }

  // 2nd option
/*  if (isset($_REQUEST['update'])) {

      $image=addslashes($_FILES['image']['tmp_name']);
      $name=addslashes($_FILES['image']['name']);
      $image=file_get_contents($image);
      $image=base64_encode($image);
      $title=$_REQUEST['title'];
      $cat_id=$_REQUEST['cat_id'];
      $content=$_REQUEST['content'];
      $status=$_REQUEST['status'];
      $edit_art=$_REQUEST['edit_art'];
     if($connect->update("articles","title='$title',img_name='$name',image='$image',cat_id='$cat_id',content='$content',status='$status'","art_id='$edit_art'")){
         $msg="<h3 class=\"success\">Article Update Success</h3>";
      }
      else{
           $msg="<h3 class=\"delete\">Article Update Fail!</h3>";
      }
    
  }*/
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
    echo $obj->msg();
    ?>
    <div id="delete">
      <!-- delete option code:::::::::::::::::::::: -->
      <?php
        if (isset($_REQUEST['crtdel_id'])) {
          $crtdel_id=$_REQUEST['crtdel_id'];

      ?>
         <p class="delete">Do you want to Delete <a class="btn small orange" href="articles.php?cdel_id=<?=$crtdel_id;?>">Yes</a>
         &nbsp;&nbsp;
         <a class="btn small orange" href="articles.php">No</a></p>
      <?php
        }

        if (isset($_REQUEST['cdel_id'])) {
          $cdel_id=$_REQUEST['cdel_id'];

          // delete function call:::::::::::::::::
        if ($connect->delete("articles","art_id='$cdel_id'")){
            $_SESSION['msg']="Delete Success";
            header("location:articles.php");
          }
          else{
            $_SESSION['msg']="Delete Fail!";
          }

        }
      ?>
    </div>

    <div class="main">
      <h2 class="manage">Manage Article</h2>
      <!-- <?=@$msg; ?> -->

<!-- edit set value php code:::::::::::::::::::::::::: -->
  <?php
  if (isset($_REQUEST['art_id'])){
    $art_id=$_REQUEST['art_id'];
    extract($connect->getByid("articles","*","art_id='$art_id'"));
  ?>

   
    <!-- <?=@$msg;?> -->
    <!-- Article edit from::::::::::::::::::::::: -->
     <h2 class="m_h">Edit Article</h2>
    <form action="articles.php" method="post" enctype="multipart/form-data">
        <table border="1" align="center" cellpadding="5" class="head">
          <tr>
            <th>Article Title</th>
            <td><input type="text" value="<?Php echo isset($title)?$title:'';?>" name="title" size="33"></td>
          </tr>
          <tr>
            <th>Select Image</th>
            <td><?php echo '<img height="200" width="250" src="'.$image.'">';?>
              <br>
              <p style="color:#fff; background:#666;padding: 5px;max-width: 250px;">Replace image...</p>
              <input type="file" name="image" value="<?php echo $img_name;?>">
              
            </td>
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
               <!-- categories select:::::::::::::::::::::::: -->
          <tr>
            <th>Select Categories</th>
            <td>
              <select name="cat_id">
                <?php
                   $categories=$connect->getall("categories","*");
                   foreach ($categories as $category) {
                   extract($category);
               ?>
             
               <option value="<?php echo $cat_id;?>"><?php echo $name; ?></option>
           
            <?php
                }
          ?>
        </select>
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
              <input type="hidden" name="edit_art" value="<?php echo $art_id;?>">
              <input type="submit" name="update" value="Update" class="btn orange">
            </td>
          </tr>
          
        </table>
      </form>
<?php
  }
  else{
?>
     <!-- articles insert form::::::::::::::::::::::::::::: -->
       <h2 class="m_h">Add a new Article</h2>
      <form action="articles.php" method="post" enctype="multipart/form-data">
        <table border="1" align="center" cellpadding="5" class="head">
          <tr>
            <th>Article Title</th>
            <td><input type="text"  name="title" size="30"></td>
          </tr>
          <tr>
            <th>Select Image</th>
            <td><input type="file" name="image"></td>
          </tr>
          <tr>
            <th>Content</th>
            <td>
              <textarea name="content" id="content" cols="50" rows="5"></textarea>
              <script>
              // Replace the <textarea id="editor1"> with a CKEditor
              // instance, using default configuration.
              CKEDITOR.replace( 'content' );
              </script>
            </td>
          </tr>
          <!-- categories select:::::::::::::::::::::::: -->
          <tr>
            <th>Select Categories</th>
            <td>
              <select name="cat_id">
                <?php
                   $categories=$connect->getall("categories","*");
                   foreach ($categories as $category) {
                   extract($category);
               ?>
               <option value="<?=$cat_id;?>"><?php echo $name; ?></option> 

            <?php
                }
          ?>
        </select>
            </td>
          </tr>
          <!-- status:::::::::::::::::::::::inser -->
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
      <table border="1" cellspacing="5" width="800" style="text-align: center;" class="action_size action_table ">
        <tr>
          <th>Name</th>
          <th>Category</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
        $articles=$connect->getall("articles","*");
        if(is_array($articles)){
        foreach ($articles as $article){
        extract($article);
        
        ?>
        <tr>
          <td><?=$title;?></td>
          <td>
            <?php

              extract($connect->getByid("categories","*","cat_id='$cat_id'"));
              echo $name;
            ?>
          </td>
          <td>
             <?php echo $status==1?"Publish":"Unpublish";?>
          </td>
          <td>
            <a class="btn small orange" href="articles.php?art_id=<?=$art_id;?>">Edit</a>&nbsp;
            <a class="btn small orange" href="articles.php?crtdel_id=<?=$art_id;?>">Delete</a>
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