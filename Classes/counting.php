<?php
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";
?>
<?php 
class Counting{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function adsclicks($usrId)
	{
		$datetime = date("Y/m/d");
		$query = "SELECT userId, count(userId) FROM tbl_ads_count WHERE userId = '$usrId' AND taskViewTime = '$datetime' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function referrals($userRfrName)
	{
		$query = "SELECT userRfrName, count(userRfrName) FROM tbl_user WHERE userRfrName = '$userRfrName' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getuserclickrfr($userRfrName)
	{
		$query = "SELECT * FROM tbl_user  WHERE userRfrName = '$userRfrName' ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>