<?php
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";
?>
<?php 
class Task{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
  public function getAllTasks()
	{
		$query = "SELECT * FROM tbl_task ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getAllTasksbyId($id)
	{
		$query = "SELECT * FROM tbl_task WHERE taskId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function inserTaskClkbyId($id, $usrId, $clicks)
	{
		$datetime = date("Y/m/d");
		$chkqry = "SELECT * FROM tbl_ads_count WHERE taskId = '$id' AND userId = '$usrId' AND taskViewTime = '$datetime'";
		$getchkclk= $this->db->select($chkqry);
		if($getchkclk){
			$msg= "this ad viewed Today <br> <a class='btn btn-danger' href='tasks.php'> back<a> <script>window.location.assign('tasks.php')</script>";
			return $msg;
		}else{
		$querys = "UPDATE  tbl_user
		SET
		userAdsClick = '$clicks' WHERE userId = '$usrId' ";
		$updated_row = $this->db->update($querys);
		$query = "INSERT INTO tbl_ads_count(userId, taskId ,taskViewTime) VALUES ('$usrId','$id','$datetime')";
			$insertclk = $this->db->insert($query);
			if ($insertclk) {

				$msg= "Thanks <br> <a class='btn btn-success' href='tasks.php'> back<a> <script>window.location.assign('tasks.php')</script>";
			return $msg;
			}else{
				$msg = "erros!";
			return $msg ;
		}
		}
	}
	public function chkviewedads($id, $usrId)
	{
		$query = "SELECT * FROM tbl_ads_count WHERE taskId = '$id' AND userId = '$usrId' ORDER BY clickid DESC";
		$result= $this->db->select($query);
		return $result;
	}
	public function getAdsClkByid($usrId)
	{
		$query = "SELECT * FROM tbl_user WHERE userId = '$usrId' ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>