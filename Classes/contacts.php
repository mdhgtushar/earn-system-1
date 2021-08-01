<?php 
include_once "../lib/Database.php";
include_once "../helpers/helper.php";
include_once "../config/config.php";

 ?>
<?php 
class Contact{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
  public function getAllTasks()
	{
		$query = "SELECT * FROM tbl_contacts";
		$result = $this->db->select($query);
		return $result;
	}
  public function getContactById($id)
	{
		$query = "SELECT * FROM tbl_contacts WHERE cntId = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function delCt($id)
	{
		$query = "DELETE FROM  tbl_contacts WHERE cntId = '$id'";
		$deldata = $this->db->delete($query);
		
		if ($deldata) {
				$msg = "delete success this !";
			return $msg ;
			}else{
				$msg = "not delet this !";
			return $msg ;
			}
	}
}
?>