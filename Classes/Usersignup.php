<?php 
include "lib/Session.php";
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";

class Userlogin{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function userLogin($userName, $userEmail ,$userPhone){
		$userName = $this->fm->validation($userName);
		$userEmail = $this->fm->validation($userEmail);
		$userPhone = $this->fm->validation($userPhone);
		
		$userName = mysqli_real_escape_string($this->db->link, $userName);
		$userEmail = mysqli_real_escape_string($this->db->link, $userEmail);
		$userPhone = mysqli_real_escape_string($this->db->link, $userPhone);
		if(empty($userName) || empty($userEmail)){
			$loginmsg = "fill this";
			return $loginmsg;
		}
		else {
			$query = "INSERT INTO tbl_user(userName, userEmail, userPhone) Values('$userName', '$userEmail', '$userPhone')";
			$create = $this->db->insert($query);
			if(isset($create)){
				
			} else {
				$loginmsg = "input incorrect";
					return $loginmsg;
			}
		}
	}
	
	public function insertSignup($data)
	{
		$userName = mysqli_real_escape_string($this->db->link , $data['userName']);
		$userEmail = mysqli_real_escape_string($this->db->link , $data['userEmail']);
		$uniqueUserName = mysqli_real_escape_string($this->db->link , $data['uniqueUserName']);
		$userPhone = mysqli_real_escape_string($this->db->link ,  $data['userPhone']);
		$userPass = mysqli_real_escape_string($this->db->link ,  md5($data['userPass']));
		$userPin = mysqli_real_escape_string($this->db->link ,  md5($data['userPin']));
		$userRfrName = mysqli_real_escape_string($this->db->link ,  $data['userRfrName']);
		$date = date('Y-m-d H:i:s');
		
		
		$chkqry = "SELECT * FROM tbl_user WHERE userPass = '$userPin' AND userPin = '$userPin'";
		$getchkclk= $this->db->select($chkqry);
		if($getchkclk){
			$usrnamechk = "SELECT * FROM tbl_user WHERE uniqueUserName = '$uniqueUserName' ";
			$getchkclk= $this->db->select($usrnamechk);
			if ($getchkclk){
				$msg= "Username Already Exiest";
			return $msg;
			}else{
		$query = " UPDATE tbl_user
		SET
		userName = '$userName',
		userEmail = '$userEmail',
		userPhone = '$userPhone',
		userPass = '$userPass',
		uniqueUserName = '$uniqueUserName',
		userRfrName = '$userRfrName'  ,
		userAccountCreated	 = '$date'
		WHERE userPass = '$userPin' " ;
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			return header("Location:scuppf.php");
		}else{
			$msg = "not updated this !";
		return $msg ;
		}	
		}
		}else{
			$msg= "Pin Is Not Matched";
			return $msg;
		 }
	}
	
	
	public function insertuserPin($data)
	{
		$userName = mysqli_real_escape_string($this->db->link ,$data['userName']);
		$userPhone = mysqli_real_escape_string($this->db->link ,$data['userPhone']);
		$userEmail = mysqli_real_escape_string($this->db->link ,$data['userEmail']);
		$userRfrName = mysqli_real_escape_string($this->db->link ,$data['userRfrName']);
		if (empty($userPId)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
			$query = "INSERT INTO tbl_user_for_pin(userName, userPhone, userEmail, userPId,userRfrName) VALUES ('$userName', '$userPhone', '$userEmail', '$userPId', '$userRfrName')";
			$insertPin = $this->db->insert($query);
			if ($insertPin) {
				$msg="Request inserted";
				return $msg ;
			}else{
				$msg = "Request not inserted!" ;
			return $msg ;
			}
		}
	}
	//reffer
	public function insertrfr($userRfrName)
	{
		$userRfrName = $this->fm->validation($userRfrName);
		$userRfrName = mysqli_real_escape_string($this->db->link , $userRfrName);
		if (empty($userRfrName)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
			$query = "INSERT INTO tbl_rfr(userRfrName) VALUES ('$userRfrName')";
			$insertPin = $this->db->insert($query);
		}
	}
	
	
}
?>