<?php
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";

class AdsView{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function Adsviewcount($clickCount){
		
}
}
?>