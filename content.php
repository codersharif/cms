<section id="content">
  <!-- content code:::::::::::::::::::::::::: -->
  <?php
  /*menu show content section by menu  code by function call ::::::::::::::::::::::
  ::::::::::::::::::::::develop by sharif khan:::::::::::::::::::::*/
  if (isset($_REQUEST['menu_id'])){
  $menu_id=$_REQUEST['menu_id'];
  $menu_show=$connect->getByid("menus","*","menu_id='$menu_id'");
  if (is_array($menu_show)){
  extract($menu_show);
  echo "<h2>".$name."</h2>";
  echo "<p>".$content."<p>";
    }
    else{
    echo "no data..";
    }
    }
    /*side bar e articles show in content section by categories  code by function call
    :::::::::::::::::::::::::::develop by sharif khan ::::::::::::::::::::::*/
    elseif (isset($_REQUEST['cat_id'])){
    $cat_id=$_REQUEST['cat_id'];
    $all_articles=$connect->getallwithcondition("articles","*","cat_id='$cat_id'");
    if (is_array($all_articles)) {
    foreach($all_articles as $article){
      extract($article);
      echo "<h2>$title</h2>";
    echo '<img height="400" width="650" src="admin/'.$image.'">';
      //echo "<p>$content</p>";
    //:::::::str to arry && arry to str convert part::::::::::sharif khan:::::::::
    $new_content=explode(" ",$content);
    $readmore_part=array_slice($new_content,0,50);
    echo implode(" ",$readmore_part);
    
    ?>
    <a href="index.php?readmore=<?=$art_id;?>">...read more</a>
    <?php
      }
    }
    else{
    echo "no data";
    }
      
    }

    elseif(isset($_REQUEST['readmore'])){

    $readmore=$_REQUEST['readmore'];
    $readmoreP_cat=$connect->getByid("articles","*","art_id='$readmore'");
    if (is_array($readmoreP_cat)){
        extract($readmoreP_cat);
        echo "<h2>".$title."</h2>";
        echo '<img height="400" width="650" src="admin/'.$image.'">';
        echo "<p>".$content."<p>";
    }
    else{
      echo "No Data..";
    }


      }
      /*side bar e articles show code by function call:::::::::::::::::::::::::::::::::::::::::::
      :::::::::::::::::::::::::::::::::::develop by sharif khan ::::::::::::::::::::::*/
      elseif(isset($_REQUEST['art_id'])){
      $art_id=$_REQUEST['art_id'];
      $article_show=$connect->getByid("articles","*","art_id='$art_id'");
      if (is_array($article_show)){
      extract($article_show);
      echo "<h2>".$title."</h2>";
       echo '<img height="400" width="650" src="admin/'.$image.'">';
      //echo "<p>".$content."<p>";
        //:::::::str to arry && arry to str convert part::::::::::sharif khan:::::::::
        $new_art_content=explode(" ",$content);
        $readmore_part_two=array_slice($new_art_content,0,50);
        echo implode(" ",$readmore_part_two);
        ?>
        <a href="index.php?readmore_two=<?=$art_id;?>">...read more</a>
        <?php
        }
        else{
        echo "No data...";
        }
        
        }
        elseif(isset($_REQUEST['readmore_two'])){
        $readmore_two=$_REQUEST['readmore_two'];
        $readmoreP=$connect->getByid("articles","*","art_id='$readmore_two'");
        if (is_array($readmoreP)){
        extract($readmoreP);
        echo "<h2>".$title."</h2>";
        echo '<img height="400" width="650" src="admin/'.$image.'">';
        echo "<p>".$content."<p>";
          }
          else{
          echo "No Data..";
          }
          
          }
          // home page show
          else{
            $articles_desc=$connect->select_orderBy_desc("articles","*","art_id");
          if (is_array($articles_desc)){
          foreach ($articles_desc as $desc){
          extract($desc);
          echo "<h2>".$title."</h2>";
          echo '<img height="400" width="650" src="admin/'.$image.'">';
          echo "<p>".$content."<p>";
            }
            }
            else{
            echo "Data empty";
            }
            }
            //:::::::::::::::::::::::::::::::::::::::::::::::::::
            /*  if (is_array(var)){
            //  valu code:::::
            }else{
            //echo no data
            }
            */
            ?>
          </section>