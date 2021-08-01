<?php 
include_once "../lib/Database.php";
include_once "../helpers/helper.php";
include "../config/config.php";

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
	public function taskInsert($data, $file){
	$taskTitle		 = mysqli_real_escape_string($this->db->link , $data['taskTitle']);
	$taskPrice 		 = mysqli_real_escape_string($this->db->link , $data['taskPrice']);
	$taskLink 	 	 = mysqli_real_escape_string($this->db->link , $data['taskLink']);
	
	$permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['taskImage']['name'];
    $file_size = $file['taskImage']['size'];
    $file_temp = $file['taskImage']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;
	if($taskTitle == "" || $taskPrice == "" || $taskLink == ""){
		$msg="empty";
				return $msg ;
	}else{
		 move_uploaded_file($file_temp, $uploaded_image);
		 $query = "INSERT INTO tbl_task(taskTitle, taskPrice, taskLink, taskImage) 
		 VALUES('$taskTitle', '$taskPrice', '$taskLink', '$uploaded_image')";
		 $taskinsert = $this->db->insert($query);
			if ($taskinsert) {
				$msg = "<span>Task inserted</span>";
				return $msg;
			}else{
				$msg = "Task not inserted!";
			return $msg ;
			}
	}
  }
  public function getAllTasks()
	{
		$query = "SELECT * FROM tbl_task ";
		$result = $this->db->select($query);
		return $result;
	}
	public function delpinUserById($id)
	{
		$query = "DELETE FROM  tbl_task WHERE taskId = '$id'";
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