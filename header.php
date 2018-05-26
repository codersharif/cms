<header id="header">
	<h1 id="logo">
		<a href="index.php">
			<!-- <img src="img/logo.png" alt="logo"> -->
	   <?php
        $logo=$connect->select_orderBy_desc_limit("logo","*","logo_id");
        if (is_array($logo)){
        foreach ($logo as $logovalue){
        extract($logovalue);
         echo '<img style=\'margin-top: 15px;margin-left: 15px;max-width: 80px;height: 80px;\' height="80" width="80" src="admin/'.$image.'">';
      
            }
        }
        else{
        	echo "Logo!";
        }

          ?>
		</a>
	</h1>
	<nav id="nav">
		<ul>
			<li><a href="index.php">Home</a></li>

			<?php
			   $menus=$connect->getallwithcondition("menus","*","status='1'");

			   foreach ($menus as $menu) {
			   	 extract($menu);
			?>
			   <li>
			   	<a href="index.php?menu_id=<?=$menu_id;?>"><?=$name; ?></a>
			   </li>
			<?php
			  
			  }
			?>
			<li><a href="./admin/login.php">Login</a></li>
		</ul>
	</nav>
</header>