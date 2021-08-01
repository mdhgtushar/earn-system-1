<?php
Class Databasenew{
 public $hostdb   = "localhost";
 public $userdb   = "root";
 public $passdb   = "" ;
 public $namedb = "db_mhs" ;
 public $pdo;
 
 
 public function __construct(){
  if (!isset($this->pdo)) {
	  try{
		  $link = new PDO ("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);
		  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $link->exec("SET CHARACTER SET utf8");
		  $this->pdo = $link;
	  }catch(PDOExeption $e){
		  die("failed".$e->getMessage);
	  }
  }
 }
}