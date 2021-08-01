<?php 
include "../lib/Session.php";
session::checkLogin();
include_once "../lib/Database.php";
include_once "../helpers/helper.php";
include "../config/config.php";

class Adminlogin{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function adminLogin($adminUser, $adminPass){
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);
		
		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
		if(empty($adminUser) || empty($adminUser)){
			$loginmsg = "input please";
			return $loginmsg;
		} else {
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
			$result = $this->db->select($query);
			if($result != false){
				$value = $result->fetch_assoc();
				session::set("adminlogin", true);
			session::set("adminId", $value['adminId']);
			session::set("adminUser", $value['adminUser']);
			session::set("adminName", $value['adminName']);
			session::set("adminEmail", $value['adminEmail']);
			header("Location:dashbord.php");
			} else {
				$loginmsg = "input incorrect";
					return $loginmsg;
			}
		}
	}
}
?>