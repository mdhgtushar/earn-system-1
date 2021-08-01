<?php 
include_once "../lib/Database.php";
include_once "../helpers/helper.php";
include_once "../config/config.php";

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
	$postTitle		 = mysqli_real_escape_string($this->db->link , $data['postTitle']);
	$postText 		 = mysqli_real_escape_string($this->db->link , $data['postText']);
	
	
	$permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['postImage']['name'];
    $file_size = $file['postImage']['size'];
    $file_temp = $file['postImage']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;
	if($postTitle == "" || $postText == ""){
		$msg="empty";
				return $msg ;
	}else{
		 move_uploaded_file($file_temp, $uploaded_image);
		 $query = "INSERT INTO tbl_admin_post(postTitle, postText, postImage) 
		 VALUES('$postTitle', '$postText','$uploaded_image')";
		 $taskinsert = $this->db->insert($query);
			if ($taskinsert) {
				$msg = "<span>post inserted</span>";
				return $msg;
			}else{
				$msg = "post not inserted!";
			return $msg ;
			}
	}
  }
  public function getAllTasks()
	{
		$query = "SELECT * FROM tbl_admin_post ";
		$result = $this->db->select($query);
		return $result;
	}
	public function delpinUserById($id)
	{
		$query = "DELETE FROM  tbl_admin_post WHERE postId = '$id'";
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