<!-- nav::::::::::::::::::::::::::::::::: -->
<nav>
  <div style="text-align: right;margin-top: 0px;margin-left: 0px;">
    <div style="">
     <!-- <img src="img/slogo.png" alt="logo" style="width:80px;height: 80px;float: left;"> margin-bottom: 33px;-->
      <h3 >Welcome&nbsp;<?php echo $_SESSION['name']."!"; ?>
      <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="profile" style="max-width: 40px;height: 40px; margin-top: 1px;margin-bottom: 0px;margin-left: 5px; border-radius: 50%;">

      <button type="button" style="margin-top: 7px;margin-bottom: 4px;margin-left: 10px;
    margin-right: 15px;" class="btn small orange">
      &nbsp;&nbsp;<a class="logout" href="dashboard.php?action=logout">logout</a>
      </button>
    </div>
    
  </div>
  <ul class="clearfix">
    <li class="current">
      <a href="dashboard.php">Dashboard</a>
    </li>
    <li>
      <a href="menus.php">Manage Menus</a>
    </li>
    <li>
      <a href="categories.php">Manage Categories</a>
    </li>
    <li>
      <a href="articles.php">Manage Articles</a>
    </li>
    <li>
      <a href="users.php">Manage Users</a>
    </li>
    <li>
      <a href="logo.php">Manage Logo</a>
    </li>
  </ul>
</nav>