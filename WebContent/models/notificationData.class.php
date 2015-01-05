<?php 

class notificationData{
	
	private $userId;
	private $ntype;
	private $nvalue;
	private $nmsg;
	
	private $data;
	
	
	
	public function __construct($data){
		$this->data = $data;
		$this->initialize();
	}
	
	private function initialize(){
		$this->verifyUserId();
		$this->verifyNType();
		$this->verifyNValue();
		$this->verifyNMsg();
	}
	
	private function verifyUserId(){
		if(isset($this->data['userId']))
			$this->userId = $this->data['userId']; 
	}
	
	private function verifyNType(){
		if(isset($this->data['ntype']))
			$this->ntype = $this->data['ntype'];
	}
	
	private function verifyNValue(){
		if(isset($this->data['nvalue']))
			$this->nvalue = $this->data['nvalue'];

	}
	private function verifyNMsg(){
		if(isset($this->data['nmsg']))
			$this->nmsg = $this->data['nmsg'];
	}
	
	function getUserId(){ 
	 	return $this->userId;
	 }
	function getNType(){
	 	return $this->ntype;
	 }
	function getNValue(){ 
	 	return $this->nvalue;
	 }
	function getNMsg(){
	 	return $this->nmsg;
	 }
	
	
}


?>