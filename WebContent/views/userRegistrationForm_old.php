<?php 
	function userRegistrationForm($user) {
?>

	<h1>E-Sports League Registration Page</h1>
			<header>
		<img src="../src/img/logo.png" alt="logo">
	</header>
		<br />
	</header>
	<h4>Fields marked with an astrisk (*) are required.</h4>
	<form action="../controllers/signupController.php" method ="Post">
	<fieldset>
		<legend>Profile Information</legend>
		First name:<input type="text" name="userProfileFirstName"  tabindex="1" required
		<?php if (!is_null($user) && !empty($user->getFirstname())) {echo 'value = "'. $user->getFirstName() .'"';}?>><br>
		Last name: <input type="text" name="userProfileLastName" tabindex="2" required
		<?php if (!is_null($user) && !empty($user->getFirstname())) {echo 'value = "'. $user->getLastName() .'"';}?>><br>
		Username: <input type="text" name="userName" tabindex="3" required
		<?php if (!is_null($user) && !empty($user->getUserName())) {echo 'value = "'. $user->getUserName() .'"';}?>>
		<span class="error"><?php if (!is_null($user)) {echo $user->getError("userName");}?></span><br>
		Date of Birth: <input type="month" name="userProfileDOB" tabindex="4" required
		<?php if (!is_null($user) && !empty($user->getDOB())) {echo 'value = "'. $user->getDOB() .'"';}?>><br> 
		Phone Number: <input type="tel" name="userProfilePhone" tabindex="5"
		<?php if (!is_null($user) && !empty($user->getPhone())) {echo 'value = "'. $user->getPhone() .'"';}?>><br>
				
		<br>E-mail: <input type="email" name="userProfileEmail" required tabindex="6" 
		    <?php if (!is_null($user) && !empty($user->getEmail())) {echo 'value = "'. $user->getEmail() .'"';}?>>
		    <span class="error"><?php if (!is_null($user)) {echo $user->getError("userEmail");}?></span><br> 
			Password: <input type="password" name="userPassword" required tabindex="7">
			<span id="passwordError" class="error"><?php if (!is_null($user)) {echo $user->getError("userPassword");}?></span><br>
			Security Question: <br> 
			<select>
				<option value="color">What is your favorite color?</option>
				<option value="book">What is your favorite book?</option>
				<option value="streetname">What is the streetname that you grew up on?</option>
			</select> <br> 
			<input type="text" name="secQuestion" tabindex="8" required> <br> <br> 

		</fieldset>	
		<br>
		<divname="gamesPlayed">
			What games do you play?<br> 
			<input type="checkbox" name="userProfileGamesList[]" value="csgo" tabindex="9">Counter-Strike:
			Global Offensive<br> 
			<input type="checkbox" name="userProfileGamesList[]" value="lol" tabindex="10">League of Legends<br> 
			<input type="checkbox" name="userProfileGamesList[]" value="dota" tabindex="11">DOTA 2<br>
		</div>	
		<br>
		<divname="color">
			Choose your Color: <br> <input type="color"name="userProfileFavColor"
				tabindex="12">
		</div>
		<br>

		<divname="avatar">
			Choose your avatar:<br> 
				<img src="../src/img/csgoavatar.png" alt="Counter-Strike:Global Offensive" width="50" height="50">
			<input type="radio" name="userProfileAvatar" class="avatar" value="csgoavatar" tabindex="13">CS:GO<br> 
				<img src="../src/img/lolavatar.png" alt="League of Legends" width="50" height="50"> 
			<input type="radio" name="userProfileAvatar" class="avatar" value="lolavatar" tabindex="14">LoL<br> 
				<img src="../src/img/dota2avatar.png" alt="Dota 2" width="50" height="50">
			<input type="radio" name="userProfileAvatar" class="avatar" value="dota2avatar" tabindex="15">Dota 2<br> <br>
			<i>Or upload your own. </i> <br> 
			<input type="file"name="userProfileAvatarUpload"><br> <br> <br>
		</div>
		<input type="submit" name = "submit" value="Submit" tabindex="16">
	</form>
	
<?php 
	return true;
	}
?>