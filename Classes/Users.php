<?php 
include_once '../lib/Database.php';
include_once '../helpers/helper.php';
include_once "../config/config.php";
?>
<?php
class Users 
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function getAllUsers()
	{
		$query = "SELECT * FROM tbl_user ORDER BY `userId` DESC";
		$result = $this->db->select($query);
		return $result;
	}
	public function userUpdate($user_payment, $userReferr, $id)
	{
		$user_payment = $this->fm->validation($user_payment);
		$userReferr = $this->fm->validation($userReferr);
		$userReferr = mysqli_real_escape_string($this->db->link , $userReferr);
		$user_payment = mysqli_real_escape_string($this->db->link , $user_payment);
		$id = mysqli_real_escape_string($this->db->link , $id);
		
			$query = "UPDATE  tbl_user
			SET
			user_payment = '$user_payment',
			userAdsClick = '$userReferr'
			WHERE userId = '$id' ";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "Updated success this !";
			return $msg ;
			}else{
				$msg = "not updated this !";
			return $msg ;
			}
		
	}
	public function getUsersById($id)
	{
		$query = "SELECT * FROM tbl_user WHERE userId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function updatePf($data, $id)
	{
		$userName = mysqli_real_escape_string($this->db->link , $data['userName']);
		$userEmail = mysqli_real_escape_string($this->db->link ,  $data['userEmail']);
		$userPhone = mysqli_real_escape_string($this->db->link ,  $data['userPhone']);
		$address = mysqli_real_escape_string($this->db->link ,  $data['address']);
		$uniqueUserName = mysqli_real_escape_string($this->db->link ,  $data['uniqueUserName']);
		$id = mysqli_real_escape_string($this->db->link , $id);
		if (empty($userName)) {
			$msg = "Fill this !";
			return $msg ;
		}else{
		$query = " UPDATE tbl_user
		SET
		userName = '$userName',
		userEmail = '$userEmail',
		userPhone = '$userPhone',
		address = '$address',
		uniqueUserName = '$uniqueUserName' 
		WHERE userId = '$id' " ;
		$updated_row = $this->db->update($query);
		if ($updated_row) {
			header("Location:scuppf.php");
		}else{
			$msg = "not updated this !";
		return $msg ;
		}
		}
	}
	public function delpinUserById($id)
	{
		$query = "DELETE FROM  tbl_user WHERE userId = '$id'";
		$deldata = $this->db->delete($query);
		
		if ($deldata) {
				$msg = "delete success this !";
			return $msg ;
			}else{
				$msg = "not delet this !";
			return $msg ;
			}
	}
	public function referrals($userRfrName)
	{
		$query = "SELECT userRfrName, count(userRfrName) FROM tbl_user WHERE userRfrName = '$userRfrName' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function ptypUpdate($psts , $amountpf, $ids, $id, $user_payment)
	{
		$psts = mysqli_real_escape_string($this->db->link , $psts);
		$amountpf = mysqli_real_escape_string($this->db->link , $amountpf);
		$ids = mysqli_real_escape_string($this->db->link , $ids);
		$query = "UPDATE  tbl_payment
		SET
		paymentstatus = '$psts',
		paymentAmmount = '$amountpf'
		WHERE paymentId = '$ids' ";
		$updated_row = $this->db->update($query);
		$querys = "UPDATE  tbl_user
		SET
		user_payment = '$user_payment'
		WHERE userId = '$id' ";
		$updated_rows = $this->db->update($querys);
		return $updated_rows ;
		if ($updated_row) {
			$msg = "Updated success this !";
		return $msg ;
		}else{
			$msg = "not updated this !";
		return $msg ;
		}
	}
}
?>