<?php 
include_once "lib/Session.php";
Session::checkLogin();
include_once "lib/Database.php";
include_once "config/config.php";
include_once "helpers/helper.php";

class Userlogin{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function userLogin($userPass, $uniqueUserName){
		$userPass = $this->fm->validation($userPass);
		$uniqueUserName = $this->fm->validation($uniqueUserName);
		
		$uniqueUserName = mysqli_real_escape_string($this->db->link, $uniqueUserName);
		$userPass = mysqli_real_escape_string($this->db->link, $userPass);
		if(empty($uniqueUserName) || empty($userPass)){
			$loginmsg = "input please";
			return $loginmsg;
		} else {
			$query = "SELECT * FROM tbl_user WHERE userPass = '$userPass' AND uniqueUserName = '$uniqueUserName' ";
			$result = $this->db->select($query);
			if($result != false){
				$value = $result->fetch_assoc();
				session::set("adminlogin", true);
			session::set("userId", $value['userId']);
			session::set("userName", $value['userName']);
			session::set("userProfile", $value['userProfile']);
			session::set("userPhone", $value['userPhone']);
			session::set("userEmail", $value['userEmail']);
			session::set("uniqueUserName", $value['uniqueUserName']);
			session::set("address", $value['address']);
			session::set("userReferr", $value['userReferr']);
			session::set("user_payment", $value['user_payment']);
			session::set("userAdsClick", $value['userAdsClick']);
			session::set("userAccountCreated", $value['userAccountCreated']);
			header("Location:dashbord.php");
			} else {
				$loginmsg = "input incorrect";
					return $loginmsg;
			}
		}
	}
}
?>