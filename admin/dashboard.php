<?php 
	session_start();
	if (isset($_REQUEST['action'])) {
		session_destroy();
		header("location:../index.php");
	}
 // unnonpersone access code:::::::::::::::::::::
  if (!isset($_SESSION['name'])) {
    die("Un aothorized access");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<link rel="stylesheet" href="../css/dashboard.css">
	<link rel="stylesheet" href="../css/manage.css">
</head>
<body>
 <!-- nav::::::::::::::::::::::::::::::::: -->
 <?php include("dashboard_menus.php"); ?>
<div class="main d_board">
   <h2>Welcome Dashboard</h2>
</div>
</body>
</html>
