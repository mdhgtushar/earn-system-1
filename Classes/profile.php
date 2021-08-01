<?php 
include_once 'lib/Database.php';
include_once 'helpers/helper.php';
include_once "config/config.php";
?>
<?php
class updatePF 
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function updatePf($data, $id){
		$userName = mysqli_real_escape_string($this->db->link , $data['userName']);
		$userEmail = mysqli_real_escape_string($this->db->link ,  $data['userEmail']);
		$userPhone = mysqli_real_escape_string($this->db->link ,  $data['userPhone']);
		$address = mysqli_real_escape_string($this->db->link ,  $data['address']);
		$id = mysqli_real_escape_string($this->db->link , $id);
		
		
		
		if (empty($userName) || empty($userEmail) || empty($userPhone) || empty($address)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
		$query = " UPDATE tbl_user
		SET
		userName = '$userName',
		userEmail = '$userEmail',
		userPhone = '$userPhone',
		address = '$address'
		WHERE userId = '$id' " ;
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			return header("Location:logout.php");
		}else{
			$msg = "not updated this !";
		return $msg ;
		}
		}
	}

	public function GetAllPaymentReq()
	{
		$query = "SELECT * FROM tbl_payment ";
		$result = $this->db->select($query);
		return $result;
	}
	public function clkAdd($clicks, $id)
	{
		$query = "UPDATE  tbl_user
		SET
		userAdsClick = '$clicks' WHERE userId = '$id' ";
		$updated_row = $this->db->update($query);
		
	}
		public function getAdsClkByid($id)
	{
		$query = "SELECT * FROM tbl_user WHERE userId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>