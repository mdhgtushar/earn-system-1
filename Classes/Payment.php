<?php 
include_once "lib/Session.php";
include_once "lib/Database.php";
include_once "helpers/helper.php";
include_once "config/config.php";

class Payment{
	private $db;
	private $fm;
	
	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function paymentinsert($userName, $userId, $paymentMethod, $paymentNumber, $paymentAmmount, $paymentNote){
		$paymentMethod = $this->fm->validation($paymentMethod);
		$paymentNumber = $this->fm->validation($paymentNumber);
		$paymentAmmount = $this->fm->validation($paymentAmmount);
		$paymentNote = $this->fm->validation($paymentNote);
		
		$paymentMethod = mysqli_real_escape_string($this->db->link, $paymentMethod);
		$paymentNumber = mysqli_real_escape_string($this->db->link, $paymentNumber);
		$paymentAmmount = mysqli_real_escape_string($this->db->link, $paymentAmmount);
		$paymentNote = mysqli_real_escape_string($this->db->link, $paymentNote);
		if(empty($paymentNumber) || empty($paymentAmmount)){
			$loginmsg = "fill this";
			return $loginmsg;
		}
		else {
			$query = "INSERT INTO tbl_payment(userName, userId, paymentMethod, paymentNumber, paymentAmmount, paymentNote)
			Values('$userName','$userId', '$paymentMethod', '$paymentNumber', '$paymentAmmount', '$paymentNote')";
			$create = $this->db->insert($query);
			if(isset($create)){
				$loginmsg = " Succesful";
					return $loginmsg;
			} else {
				$loginmsg = "input incorrect";
					return $loginmsg;
			}
		}
	}
	public function getPending($id)
	{
		$query = "SELECT * FROM tbl_payment WHERE paymentstatus=0 ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getPayment($id)
	{
		$query = "SELECT * FROM tbl_payment WHERE paymentstatus=1 ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>