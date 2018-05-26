<?php 
class session{
public function msg(){
	    if (isset($_SESSION['msg'])){
        $output="<h3 class=\"delete\">".$_SESSION['msg']."</h3>";
        $_SESSION['msg']=NULL;
        return $output;

    }
  
	}
}

$obj=new session();

?>