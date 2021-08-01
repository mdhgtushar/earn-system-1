<?php 
include_once '../lib/Database.php';
include_once '../helpers/helper.php';
include "../config/config.php";
?>
<?php
class Pin 
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insertPin($userPin)
	{
		$userPin = $this->fm->validation($userPin);
		$userPin = mysqli_real_escape_string($this->db->link , $userPin);
		if (empty($userPin)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
			$query = "INSERT INTO tbl_user_pin(userPin) VALUES ('$userPin')";
			$insertPin = $this->db->insert($query);
			if ($insertPin) {
				$msg="pin inserted";
				return $msg ;
			}else{
				$msg = "cataegory not inserted!";
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
	
	public function getAlluserForpin()
	{
		$query = "SELECT * FROM tbl_user_for_pin ";
		$result = $this->db->select($query);
		return $result;
	}
	public function delpinUserById($id)
	{
		$query = "DELETE FROM  tbl_user_for_pin WHERE userId = '$id'";
		$deldata = $this->db->delete($query);
		
		if ($deldata) {
				$msg = "delete success this !";
			return $msg ;
			}else{
				$msg = "not delet this !";
			return $msg ;
			}
	}
	
	
	
	
	
	
	
	
	
	
	
	public function getCatById($id)
	{
		$query = "SELECT * FROM tbl_category WHERE catId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function catUpdate($catName, $id)
	{
		$catName = $this->fm->validation($catName);
		$catName = mysqli_real_escape_string($this->db->link , $catName);
		$id = mysqli_real_escape_string($this->db->link , $id);
		if (empty($catName)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
			$query = "UPDATE  tbl_category
			SET
			catName = '$catName'
			WHERE catId = '$id'";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "Updated success this !";
			return $msg ;
			}else{
				$msg = "not updated this !";
			return $msg ;
			}
		}
	}
	
}
?>