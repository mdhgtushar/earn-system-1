<?php 
include_once "../lib/Database.php";
include_once "../helpers/helper.php";
include "../config/config.php";

class AddUser{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insertUser($userPass, $userPin)
	{
		$userPass = mysqli_real_escape_string($this->db->link , $userPass);
		$userPin = mysqli_real_escape_string($this->db->link , $userPin);
		if (empty($userPass)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
			$query = "INSERT INTO tbl_user(userPass, userPin) VALUES ('$userPass', '$userPin')";
			$insertPin = $this->db->insert($query);
			if ($insertPin) {
				$msg="Request inserted";
				return $msg ;
			}else{
				$msg = "Request not inserted!";
			return $msg ;
			}
		}
	}
	
	
	
}
?>