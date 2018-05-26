<?php
class Db{
	private $conn;

	public function __construct($host,$user,$pass,$db){
        $this->conn=new mysqli($host,$user,$pass,$db);
        
        if (!$this->conn) {
            die("database fail.".$this->conn->connect_error);
        }
	}

  public function __destruct(){

  }
   // getall::::::::::::select
  public function getall($table,$cols){
      $sql="SELECT $cols FROM $table";

      $result=$this->conn->query($sql);
      if ($result->num_rows > 0) {
         return $result->fetch_all(MYSQLI_ASSOC);
      }
      else{
        return false;
      }

  }

    public function getallwithcondition($table,$cols,$condition){
      $sql="SELECT $cols FROM $table WHERE $condition";

      $result=$this->conn->query($sql);
      if ($result->num_rows > 0) {
         return $result->fetch_all(MYSQLI_ASSOC);
      }
      else{
        return false;
      }

  }

  // getByid:::::::::::::::::::::
    public function getByid($table,$cols,$condition){
      $sql="SELECT $cols FROM $table WHERE $condition";

      $result=$this->conn->query($sql);
      if ($result->num_rows > 0) {
         return $result->fetch_assoc();
      }
      else{
        return false;
      }

  }

  //:::::::::::selectby order by desc::::::::::::
   public function select_orderBy_desc($table,$cols,$condition){
      $sql="SELECT $cols FROM $table ORDER BY $condition DESC";

      $result=$this->conn->query($sql);
      if($result->num_rows > 0) {
         return $result->fetch_all(MYSQLI_ASSOC);
      }
      else{
        return false;
      }

  }
 //::::::::::::::::logo select ::::::::
    public function select_orderBy_desc_limit($table,$cols,$condition){
      $sql="SELECT $cols FROM $table ORDER BY $condition DESC LIMIT 1";

      $result=$this->conn->query($sql);
      if($result->num_rows > 0) {
         return $result->fetch_all(MYSQLI_ASSOC);
      }
      else{
        return false;
      }

  }
  //insert::::::::::::::::::::::::
    public function insert($table,$cols){
       $sql="INSERT INTO $table SET $cols";
      // echo $sql;

       $result=$this->conn->query($sql);
       if ($this->conn->affected_rows > 0) {
          return true;
       }
       else{
          return false;
       }
    } 

   //logo inser 
  /*    public function logo_insert($table,$cols){
       $sql="INSERT INTO $table SET $cols";
      // echo $sql;

       $result=$this->conn->query($sql);
       if ($result == true) {
          return true;
       }
       else{
          return false;
       }
    } */ 
  // update method::::::::::::::::::::::::
    public function update($table,$update_cols,$condition){
       $sql="UPDATE $table SET $update_cols WHERE $condition";
       //echo $sql;

       $result=$this->conn->query($sql);
       if ($this->conn->affected_rows > 0) {
          return true;
       }
       else{
          return false;
       }
    }   

    // delete ::::::::::::::::::
    public function delete($table,$condition){
        $sql="DELETE FROM $table WHERE $condition";

        $result=$this->conn->query($sql);
        if ($this->conn->affected_rows > 0) {
          return true;
        }
        else{
          return false;
        }
    }
    // login function::::::::::::::::::::::::::
    public function login($table,$cols,$condition){
       $sql="SELECT $cols FROM $table WHERE $condition";

       $result=$this->conn->query($sql);
       if ($result->num_rows == 1) {
       	  return $result->fetch_assoc();
       }
       else{
       	return false;
       }
    }


}

$connect=new Db("localhost","root","","cms");

// $connect->insert("users","name='name',email='email',password='password',role='role'status='status'");


/*print_r($connect->login("users","*","email='sharif@gmail.com' AND password='7c4a8d09ca3762af61e59520943dc26494f8941b'"));*/

?>