<section id="sidebar">
	<section>
		<h3>Magna Feugiat</h3>
		<p>Sed tristique purus vitae volutpat commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit. Sed tristique purus vitae volutpat commodo suscipit ullamcorper commodo suscipit amet sed nibh. Proin a ullamcorper sed blandit..</p>
		<footer>
			<ul class="actions">
				<li><a href="#" class="button">Learn More</a></li>
			</ul>
		</footer>
	</section>
	<hr />
		<section>
		<ul>
		<li class="r_post"><h2 >Recent Post...</h2></li>	
		 <?php
			$articles=$connect->select_orderBy_desc("articles","*","art_id");
			if (is_array($articles)){
	        foreach ($articles as $article) {
	         extract($article);
	      ?>

	      <li class="title">
	      	<a href="index.php?art_id=<?=$art_id;?>"><?php echo $title; ?></a>
	      </li>

	    <?php
	        }
	    }
	    else{
	    	echo "Post Empty..";
	    }

		?>
		</ul>
	
	
	</section>
	<hr />
	<section>
		<ul>
		 <?php
			$categories=$connect->getall("categories","*");
			if (is_array($categories)){
	        foreach ($categories as $category) {
	         extract($category);
	      ?>
	      <li class="title">
	      	<a href="index.php?cat_id=<?=$cat_id;?>"><?php echo $name; ?></a>
	      </li>

	    <?php
	        }
	    }
	    else{
	    	echo "category Empty....";
	    }
		?>
		</ul>
	
	
	</section>
</section>