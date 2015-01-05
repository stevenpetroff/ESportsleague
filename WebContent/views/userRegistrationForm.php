<?php 
//session_start();
function userRegistrationForm($user){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>E-Sports League</title>

    <!-- Bootstrap core CSS -->
    <link href="../src/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../src/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="../src/css/customstyle.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-default navbar-fixed-top " role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">E-Sports League</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            
            <!-- PHP FOR MENU -->    
            <?php 
				include_once(dirname(__FILE__)."/../views/menu.php");
				showMenu('registration');
			?>
      
            </div>
          </div>
        </nav>

      </div>
    </div>
<!-- END NAVBAR -->

	<div class = "container">
		<div class = "page-header">
			<h1><br>User Registration Page</h1>
		</div>
		<div class="alert alert-info" role="alert">
        	<strong>Heads up!</strong> All fields are required! <br>     		
      	</div>
<!-- 
	INCLUDE PHP HERE FOR ERROR MESSAGES 
-->  
      	<p class="lead">Account Information</p>
      	
		<form role="form" action="../controllers/signupController.php" enctype="multipart/form-data" method ="Post">
		<div class = "row">
		  <div class="form-group col-lg-4 has-feedback" id="userNameDiv">
		    <label class="control-label" for="userName">Username</label>
		    <input type="text" class="form-control" id="userName" name="userName"placeholder="Username"
		    <?php if (!is_null($user) && !empty($user->getUserName())) {echo 'value = "'. $user->getUserName() .'"';}?>>
		  </div><br>
		  		  <div class="alert alert-danger col-lg-3" id="usernameValidate"role="alert">
        		Username is already taken.      		
      	  	</div>
		</div>
		
		<div class = "row">
		  <div class="form-group col-lg-4">
		    <label for="userProfileEmail">Email address</label>
		    <input type="email" class="form-control" id="userProfileEmail" name="userProfileEmail"placeholder="Enter email"
		     <?php if (!is_null($user) && !empty($user->getEmail())) {echo 'value = "'. $user->getEmail() .'"';}?>>
		  </div>

		</div>
		
		
		<div class = "row">
		  <div class="form-group col-lg-4  has-feedback" id = "passNonVerifyDiv">
		    <label class="control-label" for="userPassword">Password</label>
		    <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password">
		  </div>
		  
		  
		   <div class="form-group col-lg-4 has-feedback" id="passVerifyDiv">
		    <label class="control-label" for="userPasswordVersify">Verify Password</label>
		    <input type="password" class="form-control" id="userPasswordVerify" name="userPasswordVerify" placeholder="Enter Password Again" aria-describedby="passFailGlyph">
		  </div><br>	
		  	<div class="alert alert-danger col-lg-2" id="passFailNotice"role="alert">
        		Passwords do not match.      		
      	  	</div>
      	  	<div class="alert alert-danger col-lg-2" id="passLengthNotice"role="alert">
        		Passwords must be at least 5 characters.     		
      	  	</div>
		  </div>
		  
		  
		  <div class = "row">
		   <div class="form-group col-lg-4">
		    <label for="userProfileFirstName">First Name</label>
		    <input type="text" class="form-control" id="userProfileFirstName" name="userProfileFirstName" placeholder="First Name">
		   </div>

           <div class="form-group col-lg-4">
           <label for="userProfileFirstName">Last Name</label>
		   <input type="text" class="form-control" id="userProfileLastName" name="userProfileLastName" placeholder="Last Name">
		  </div>
		  </div>
		  <div class = "row">
		   <div class="form-group col-lg-4">
		    <label for="userProfileDOB">Enter your Date of Birth</label>
		    <input type="date" class="form-control" id="userProfileDOB" name="userProfileDOB">
		  </div>
		  </div>
		  <div class = "row">
		   <div class="form-group col-lg-4">
		    <label for="userProfilePhone">Enter your Phone Number</label>
		    <input type="tel" class="form-control" id="userProfilePhone" name="userProfilePhone">
		  </div>
		  </div>
		  <label for="userProfileFavColor">Enter your Favorite Color</label>
		  <div class = "row">
		  <div class="form-group col-lg-1">
		    
		    <input type="color" class="form-control" id ="userProfileFavColor" name="userProfileFavColor">
		  </div>
		  </div>
		  <p class="lead"><br>Profile Information</p>
		  <div class = "form-group">
		  	<label for="userProfileGamesList[]">What games do you play?</label><br>
		  	<input type="checkbox"  id = "userProfileGamesList[]" name="userProfileGamesList[]" value="csgo" > Counter-Strike: Global Offensive<br> 
			<input type="checkbox"  id = "userProfileGamesList[]" name="userProfileGamesList[]" value="lol" > League of Legends<br> 
			<input type="checkbox"  id = "userProfileGamesList[]" name="userProfileGamesList[]" value="dota"> DOTA 2<br>
		  </div>
		  
		  
		  <div class="form-group">
		  <label for="exampleInputFile">Choose your avatar</label>
		  <br>
		  <img src="../src/img/avatar/csgoavatar.png" alt="Counter-Strike:Global Offensive" width="50" height="50">
			<input type="radio" name="userProfileAvatar" class="avatar" value="csgoavatar.png" tabindex="13">CS:GO<br> 
				<img src="../src/img/avatar/lolavatar.png" alt="League of Legends" width="50" height="50"> 
			<input type="radio" name="userProfileAvatar" class="avatar" value="lolavatar.png" tabindex="14">LoL<br> 
				<img src="../src/img/avatar/dota2avatar.png" alt="Dota 2" width="50" height="50">
			<input type="radio" name="userProfileAvatar" class="avatar" value="dota2avatar.png" tabindex="15">Dota 2<br>
	
			<i>Or upload your own. </i> <br> 
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
		    <input type="file" name ="userProfileAvatarUpload">   
		  </div>
		  <button type="submit" id="formSubmit" name="submit" value="Submit" class="btn btn-default">Submit</button>
		</form>
	</div>
	
	<script>
		$("#passFailNotice").hide();
		$("#usernameValidate").hide();
		
		$(document).ready(function () {
		   $("#userPasswordVerify").keyup(verifyPassword);
		   $("#userPassword").keyup(verifyPassword);
		   $("#userName").keyup(verifyUsername);
		});
		function verifyUsername(){
			   if($("#userName").val().length > 0)
					$.ajax({type:"POST",
							url:"../controllers/jsonPostController.php",
							data: $(this).serialize(),
							dataType: 'json',
							success: function(result){
										var obj = jQuery.parseJSON(JSON.stringify(result));
										//console.log(obj.exists);
										if(obj.exists == false){
											//alert(JSON.stringify(result));
											$("#userNameDiv").removeClass("has-error");
											$("#userNameDiv").addClass("has-success");
											$("#usernameValidate").hide();
											$("#formSubmit").prop('disabled', false);
											$("#formSubmit").prop('enabled', true);
										} else {
											//alert(JSON.stringify(result));
											$("#userNameDiv").addClass("has-error");
											$("#userNameDiv").removeClass("has-success");
											$("#usernameValidate").show();
											$("#formSubmit").prop('disabled', true);
										}
									},
							error: function(){
									alert('failed to download json string');}
					});
			   else {
				   $("#userNameDiv").removeClass("has-success");
					$("#userNameDiv").removeClass("has-error");
					$("#usernameValidate").hide();
					$("#formSubmit").prop('disabled', false);
					$("#formSubmit").prop('enabled', true);	   
			   }
				    
		}
		function verifyPassword(){
			var password = $("#userPassword").val();
			var confirmpassword = $ ("#userPasswordVerify").val();
			if (password.length <= 4){
				$("#passFailNotice").hide();
				$("#passVerifyDiv").removeClass("has-success");
				$("#passVerifyDiv").addClass("has-error");

				$("#passNonVerifyDiv").removeClass("has-success");
				$("#passNonVerifyDiv").addClass("has-error");
				
				$("#passLengthNotice").show();
				$("#formSubmit").prop('disabled', true);
				
			}else if (password != confirmpassword){
				//update error that passwords do not match
				//make submit unselectable
				$("#passLengthNotice").hide();
				$("#passVerifyDiv").removeClass("has-success");
				$("#passVerifyDiv").addClass("has-error");

				$("#passNonVerifyDiv").removeClass("has-success");
				$("#passNonVerifyDiv").addClass("has-error");
				
				$("#passFailNotice").show();
				$("#formSubmit").prop('disabled', true);
				
			}else{
				//update error that passwords match
				//make submit selectable
				$("#passLengthNotice").hide();
				$("#passVerifyDiv").removeClass("has-error");
				$("#passVerifyDiv").addClass("has-success");

				$("#passNonVerifyDiv").removeClass("has-error");
				$("#passNonVerifyDiv").addClass("has-success");
				$("#passFailNotice").hide();

				$("#formSubmit").prop('disabled', false);
				$("#formSubmit").prop('enabled', true);
			}

		}
	</script>
	 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../src//js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php 
}
?>