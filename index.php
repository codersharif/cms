<?php include("database.php");?>
<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Right Sidebar - Landed by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../css/manage.css">
		<link rel="stylesheet" href="css/sidebar.css"/>
		<link rel="stylesheet" href="css/main.css"/>

		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">
			<!-- Header -->
			<?php
			include("header.php");
			?>
			<!-- Main -->
			<div id="main" class="wrapper style1">
				<div class="container">
					<header class="major">
						<h2>Right Sidebar</h2>
						<p>Ipsum dolor feugiat aliquam tempus sed magna lorem consequat accumsan</p>
					</header>
					<div class="row 150%">
						<div class="8u 12u$(medium)">
							<!-- Content -->
							<?php
							include("content.php");
							?>
							
						</div>
						<div class="4u$ 12u$(medium)">
							<!-- Sidebar -->
							<?php
							include("sidebar.php");
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer -->
			<?php
			include("footer.php");
			?>
		</div>
		<!-- Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/jquery.scrollex.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="js/main.js"></script>
	</body>
</html>