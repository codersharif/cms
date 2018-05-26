<?php
 include("../database.php");
 include("alert_function.php");
 session_start();

 if (isset($_REQUEST['submit'])) {
 	 extract($_REQUEST);
 	 $password=sha1($password);

 	 if ($connect->login("users","*","email='$email' AND password='$password'")!=false) {
 	 	

 	 	$user_info=$connect->login("users","*","email='$email' AND password='$password'");

 	 	$_SESSION['name']=$user_info['name'];
 	 	$_SESSION['profile_pic']=$user_info['profile_pic'];
 	 	//echo $_SESSION['name'];

 	 	header("location:dashboard.php");
 	 }
 	 else{
 	 	
 	 	  $msg="Email and password don\'t match!";
          echo $alert_obj->alert($msg);
 	 }

 }

 if (isset($_SESSION['name']['profile_pic'])) {
 	header("location:dashboard.php");
 }
  
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>cms login page</title>
<link rel="stylesheet" type="text/css" href="../css/login.css" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Login Form</h1>
			<div>
				<input type="text" name="email" placeholder="Email" required="" />
			</div>
			<div>
				<input type="password" name="password" placeholder="Password" required="" />
			</div>
			<div>
				<input type="submit" name="submit" value="Log in" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>