<?php
class alarm {
 public function alert($msg){
 	$al= "<script>";
    $al.="alert('$msg');";
    $al.="</script>";
    return $al;
 } 
}

$alert_obj=new alarm(); 
 ?>