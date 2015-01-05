<?php 

class teamData{
	
	private $teamId;
	private $teamName;
	private $teamGame;
	private $teamCaptain;
	private $teamWin;
	private $teamLoss;
	private $teamAvatar;
	private $teamColor;
	private $teamMembers;
	private $teamMemberCount;
	
	//errors
	private $errorCount;
	private $errors;
	private $formInput;
	private $roster;
	public function __construct($formInput = null,$roster = array()){
		$this->formInput = $formInput;
		$this->teamMembers = $roster;
		if (is_null($formInput))
			$this->initializeEmpty();
		else
			$this->initialize();
	}
	
	private function initialize() {
		$this->errorCount = 0;
		$errors = array();
		$this->verifyTeamId();
		$this->verifyTeamName();
		$this->verifyTeamGame();
		$this->verifyTeamCaptain();	
		$this->verifyTeamWin();
		$this->verifyTeamLoss();
		$this->verifyTeamAvatar();
		$this->verifyTeamColor();
		//$this->verifyTeamMembers();
	}
	
	private function initializeEmpty() {
		 $this->errorCount = 0;
		 $errors = array();
		 $this->teamId = "";
		 $this->teamName="";
		 $this->teamGame="";
		 $this->teamCaptain="";
		 $this->teamWin="";
		 $this->teamLoss="";
		 $this->teamAvatar="";
		 $this->teamColor="";
		 $this->teamMembers= array();
			
	}
	
	private function verifyTeamId(){
		if (isset($this->formInput['teamId']))
			$this->teamId =$this->formInput['teamId'];
	}
	private function verifyTeamName(){
		if (isset($this->formInput['teamName']))
			$this->teamName =$this->formInput['teamName'];
	}
	private function verifyTeamGame(){
		if (isset($this->formInput['teamGame']))
			$this->teamGame =$this->formInput['teamGame'];
	}
	private function verifyTeamCaptain(){
		if (isset($this->formInput['teamCaptain']))
			$this->teamCaptain =$this->formInput['teamCaptain'];
	}
	private function verifyTeamWin(){
		if (isset($this->formInput['teamWin']))
			$this->teamWin =$this->formInput['teamWin'];
	}
	private function verifyTeamLoss(){
		if (isset($this->formInput['teamLoss']))
			$this->teamLoss =$this->formInput['teamLoss'];
	}
	private function verifyTeamAvatar(){
		if (isset($this->formInput['teamAvatar']))
			$this->teamAvatar =$this->formInput['teamAvatar'];
	}
	private function verifyTeamColor(){
		if (isset($this->formInput['teamColor']))
			$this->teamColor =$this->formInput['teamColor'];
	}
	private function verifyTeamMembers(){
		$this->teamMembers = array();
		$list = $this->roster;
		if (isset($list)){
			if(is_array($list)){
				for($k = 1,$c = count($list);$k<=$c;$k++){
					$value = $list['m'.$k];
					if($value == 'empty')
						$value = "Empty Slot";
					array_push($this->teamMembers,$value);
				}
			}
		}	
	}
	
	function getTeamId(){
		return $this->teamId;
	}
	function getTeamName(){
		return $this->teamName;
	}
	function getTeamGame(){
		return $this->teamGame;
	}
	function getTeamCaptain(){
		return $this->teamCaptain;
	}
	function getTeamWin(){
		return $this->teamWin;
	}
	function getTeamLoss(){
		return $this->teamLoss;
	}
	function getTeamAvatar(){
		return $this->teamAvatar;
	}
	function getTeamColor(){
		return $this->teamColor;
	}
	function getTeamMembers(){
		return $this->teamMembers;
	}
	function getTeamMemberCount(){
		return $this->teamMemberCount;
	}
	public function getError($errorName) {
		if (isset($this->errors[$errorName]))
			return $this->errors[$errorName];
		else
			return "";
	}

	public function getErrorCount() {
		return $this->errorCount;
	}
	
	public function getErrors() {
		return $this->errors;
	}
}

?>