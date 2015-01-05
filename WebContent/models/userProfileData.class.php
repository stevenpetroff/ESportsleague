<?php 

class userProfileData {
	//new user profile info
	private $userName;
	private $userProfileId;
	private $userProfileFirstName;
	private $userProfileLastName;
	private $userProfileDOB;
	private $userProfilePhone;
	private $userProfileFavColor;
	private $userProfileAvatar;
	private $userProfileEmail;
	private $userProfileGamesMap;
	private $userProfileGamesList;
	private $teamId;
	/* non user profile vars*/
	private $errorCount;
	private $errors;
	private $formInput;
	
	public function __construct($formInput = null, $gamesMap = array()) {
		$this->formInput = $formInput;
		$this->userProfileGamesMap = $gamesMap;
		if(is_null($formInput))
			$this->initializeEmpty();
		else
			$this->initialize();
	}

	public function getUserName(){
		return $this->userName;
	}
	public function getFirstName(){
		return $this->userProfileFirstName;
	}
	public function getLastName(){
		return $this->userProfileLastName;
	}
	public function getDOB(){
		return $this->userProfileDOB;
	}
	public function getPhone(){
		return $this->userProfilePhone;
	}
	public function getEmail(){
		return $this->userProfileEmail;
	}
	public function getFavColor(){
		return $this->userProfileFavColor;
	}
	public function getAvatar(){
		return $this->userProfileAvatar;
	}
	public function getUserProfileId(){
		return $this->userProfileId;
	}
	public function getTeamId(){
		return $this->teamId;
	}
	public function getGamesList(){
		return $this->userProfileGamesList;
	}
	public function setGamesList($list){
		$this->userProfileGamesList = $list;
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
	public function setFirstName($input){
		if (isset($this->formInput['userProfileFirstName']))
			$this->userProfileFirstName =
			$this->stripInput ($this->formInput['userProfileFirstName']);
		return $this;
	}
	public function getParameters(){
		$paramArray = array("userProfileId"=>$this->userProfileId,
							"userProfileFirstName"=>$this->userProfileFirstName,
							"userProfileLastName"=>$this->userProfileLastName,
							"userProfileDOB"=>$this->userProfileDOB,
							"userProfilePhone"=>$this->userProfilePhone,
							"userProfileEmail"=>$this->userProfileEmail,
							"userProfileFavColor"=>$this->userProfileFavColor,
							"userProfileAvatar"=>$this->userProfileAvatar,
							"userProfileGamesList"=>$this->userProfileGamesList
							);
		return $paramArray;
	}
	
	public function __toString() {
		$arr = var_export($this->userProfileGamesList,true);
		$str = "Id:[".$this->userProfileId. "]" .
				" First name:[".$this->userProfileFirstName."]" .
				" Last name:[".$this->userProfileLastName."]" .
				" Email:[".$this->userProfileEmail."]".
				" DOB:[".$this->userProfileDOB."]" .
				" FavColor:[".$this->userProfileFavColor."]" .
				" Avatar:[".$this->userProfileAvatar."]" .
				" GamesList:[".$arr."]" .
				" Last name:[".$this->userProfileLastName."]" ;
		return $str;
	}
	
	private function initialize() {
		$this->errorCount = 0;
		$errors = array();
		$this->verifyUserName();
		$this->verifyUserProfileId();
		$this->verifyUserProfileFirstName();
		$this->verifyUserProfileLastName();
		$this->verifyUserProfileEmail();
		$this->verifyUserProfileDOB();
		$this->verifyUserProfilePhone();
		$this->verifyUserProfileFavColor();
		$this->verifyUserProfileAvatar();
		$this->verifyUserProfileGamesList();
		if(isset($this->formInput['teamId']))
			$this->teamId = $this->formInput['teamId'];
	}
	public function editProfile($input){
		$this->verifyUserProfileFirstName();
		$this->verifyUserProfileLastName();
		$this->verifyUserProfileEmail();
		$this->verifyUserProfilePhone();
		$this->verifyUserProfileAvatar();
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->userProfileId="";
		$this->userProfileFirstName="";
		$this->userProfileLastName="";
		$this->userProfileDOB="";
		$this->userProfilePhone="";
		$this->userProfileEmail="";
		$this->userProfileFavColor="";
		$this->userProfileAvatar="";
		$this->userProfileGamesList= array();
	}
	
	private function stripInput($data) {
		// Require most data be free of blanks, slashes and special characters
		$data = trim ( $data );
		$data = stripslashes ( $data );
		$data = htmlspecialchars ( $data );
		return $data;
	}
	
	private function verifyUserProfileId() {
		if (!isset($this->formInput['userProfileId']))
			$this->userProfileId = '';
		else {
			$this->userProfileId = $this->stripInput($this->formInput['userProfileId']);
			if (!filter_var($this->userProfileId, FILTER_VALIDATE_INT)) {
				$this->errors['userProfileId'] = "Profile ID is not a valid integer";
				$this->errorCount++;
			} elseif ((int)$this->userProfileId <= 0) {
				$this->errors['userProfileId'] = "Profile ID must be a positive integer";
				$this->errorCount++;
			}
		}
	}
	private function verifyUserName() {
		// Just do base filtering at this point
		if (isset($this->formInput['userName']))
			$this->userName =
			$this->stripInput ($this->formInput['userName']);
	}
	private function verifyUserProfileFirstName() {
		// Just do base filtering at this point
		if (isset($this->formInput['userProfileFirstName']))
			$this->userProfileFirstName =
				$this->stripInput ($this->formInput['userProfileFirstName']);
	}
	
	private function verifyUserProfileLastName() {
		// Just do base filtering at this point
		if (isset($this->formInput['userProfileLastName']))
			$this->userProfileLastName =
				$this->stripInput ($this->formInput['userProfileLastName']);
	}
	private function verifyUserProfileEmail2(){
		if (isset($this->formInput['userProfileEmail']))
			$this->userProfileEmail = $this->stripInput ( $this->formInput['userProfileEmail'] );
	}
	private function verifyUserProfileEmail() {
		// The user email must be a non-empty valid email
		// soon check for duplicates
		if (! isset ( $this->formInput['userProfileEmail'] ) ||
				empty($this->formInput['userProfileEmail'])) {
					$this->userProfileEmail = '';
					$this->errors ['userProfileEmail'] = "User email is required";
					$this->errorCount ++;
		} else {
			$this->userProfileEmail = $this->stripInput ( $this->formInput['userProfileEmail'] );
			if (! filter_var ( $this->userProfileEmail, FILTER_VALIDATE_EMAIL )) {
				$this->errors ['userProfileEmail'] = "Needs to be a valid email address.";
				$this->errorCount ++;
			}
		}
	} 
	
	
	private function verifyUserProfileDOB() {
		if (isset($this->formInput['userProfileDOB']))
			$this->userProfileDOB = $this->formInput['userProfileDOB'];
	}
	
	private function verifyUserProfilePhone() {
		if (isset($this->formInput['userProfilePhone']))
			$this->userProfilePhone =
			$this->stripInput ($this->formInput['userProfilePhone']);
	}
	
	private function verifyUserProfileFavColor() {
		if (isset($this->formInput['userProfileFavColor']))
			$this->userProfileFavColor = $this->formInput['userProfileFavColor'];
	}
	
	private function verifyUserProfileAvatar() {
		if (isset($this->formInput['userProfileAvatar']))
			$this->userProfileAvatar = $this->formInput['userProfileAvatar'];
	}
	private function verifyUserProfileGamesList() {
		// The comment tag list should contain valid entries
		$this->userProfileGamesList = array ();
		if (! isset ( $this->formInput ['userProfileGamesList'] ))
			return;
		elseif (! is_array( $this->formInput['userProfileGamesList'] )) {
			$this->userProfileGamesList = $this->formInput['userProfileGamesList'];
			$this->errors ['userProfileGamesList'] = "Games should be a list";
			$this->errorCount ++;
		} else { // Counts multiple bad tags as only one error, but lists all bad tags
			$list = $this->formInput ['userProfileGamesList'];
			for($k = 0; $k < count ( $list ); $k ++) {
				$nextGame = $this->stripInput ( $list [$k] );
				array_push ( $this->userProfileGamesList, $nextGame );
				if (! empty ( $this->userProfileGamesMap ) && ! array_key_exists ( $nextGame, $this->userProfileGamesMap )) {
					if (isset ( $this->errors ['userProfileGamesList'] ))
						$this->errors ['userProfileGamesList'] = $this->errors ['userProfileGamesList'] . "[$nextGame]";
					else {
						$this->errors ['userProfileGamesList'] = "Invalid gametag: [$nextGame]";						
						$this->errorCount ++;
					}
				}
			}
		}
	}
}

?>