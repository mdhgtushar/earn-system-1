<?php 
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";

 ?>
<?php 
class AdminPost{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
  public function getAllTasks()
	{
		$query = "SELECT * FROM tbl_admin_post ";
		$result = $this->db->select($query);
		return $result;
	}
  public function getAllTasksbyId($id)
	{
		$query = "SELECT * FROM tbl_admin_post WHERE postId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>