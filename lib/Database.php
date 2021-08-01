<?php
Class Database{
 public $host   = DB_HOST;
 public $user   = DB_USER;
 public $pass   = DB_PASS;
 public $dbname = DB_NAME;
 
 
 public $pdo;
 public $link;
 public $error;
 
 public function __construct(){
  $this->connectDB();
  if (!isset($this->pdo)) {
	  try{
		  $linke = new PDO ("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
		  $linke->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $linke->exec("SET CHARACTER SET utf8");
		  $this->pdo = $linke;
	  }catch(PDOExeption $e){
		  die("failed".$e->getMessage);
	  }
  }
 }
 
private function connectDB(){
 $this->link = new mysqli($this->host, $this->user, $this->pass, 
  $this->dbname);
 if(!$this->link){
   $this->error ="Connection fail".$this->link->connect_error;
  return false;
 }
 }
 
// Select or Read data
public function select($query){
  $result = $this->link->query($query) or 
   die($this->link->error.__LINE__);
  if($result->num_rows > 0){
    return $result;
  } else {
    return false;
  }
 }
 
// Insert data
public function insert($query){
 $insert_row = $this->link->query($query) or 
   die($this->link->error.__LINE__);
 if($insert_row){
   return $insert_row;
 } else {
   return false;
  }
 }
  
// Update data
 public function update($query){
 $update_row = $this->link->query($query) or 
   die($this->link->error.__LINE__);
 if($update_row){
  return $update_row;
 } else {
  return false;
  }
 }
  
// Delete data
 public function delete($query){
 $delete_row = $this->link->query($query) or 
   die($this->link->error.__LINE__);
 if($delete_row){
   return $delete_row;
 } else {
   return false;
  }
 }
 
}