<?php 
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";

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
  public function contactInsat($data)
	{
		$cntName = mysqli_real_escape_string($this->db->link ,$data['cntName']);
		$cntEmail = mysqli_real_escape_string($this->db->link ,$data['cntEmail']);
		$cntPhone = mysqli_real_escape_string($this->db->link ,$data['cntPhone']);
		$cntSubject = mysqli_real_escape_string($this->db->link ,$data['cntSubject']);
		$cntMsg = mysqli_real_escape_string($this->db->link ,$data['cntMsg']);
		$query = "INSERT INTO tbl_contacts(cntName, cntEmail, cntPhone, cntSubject,cntMsg) VALUES ('$cntName', '$cntEmail', '$cntPhone', '$cntSubject', '$cntMsg')";
		$insertPin = $this->db->insert($query);
		if ($insertPin) {
			$msg="thank you For contact With Us";
			return $msg ;
		}else{
			$msg = "Request not inserted!";
		return $msg ;
		}
		
	}
  
}
?>