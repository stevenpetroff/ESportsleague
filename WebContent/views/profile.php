<?php 
include_once(dirname(__FILE__)."/../controllers/profileController.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../controllers/loginController.php");
include_once(dirname(__FILE__)."/../views/login.php");
include_once (dirname(__FILE__)."/../views/error.php");

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_GET['user'])){
	if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
		$profile = getProfile($_GET['user']);
		if(!isset($profile)){
			profileNotFound();
		}else{
		printProfile($profile);
		}
	} else{
		//echo"You must be logged in to view this profile";
		$redirect = $_GET;
		loginForm($user,"unauthenticated");		
	}
}else{
	if(basename($_SERVER['PHP_SELF']) == "profile.php")
		printError('404profile');
}

function showProfile($profile){
	//print_r($profile);
	echo"<h1> ".$profile->getUserName()."'s Profile </h1>";
	echo" <img src=\"../src/img/avatar/".$profile->getAvatar()."\" alt=\"".$profile->getAvatar()."\" width=\"150\" height=\"150\"> <br>";
	echo"Name: ".$profile->getFirstName()." ".$profile->getLastName()." <br>";
	echo"Email: ".$profile->getEmail()."<br>";
	echo"Phone: ".$profile->getPhone()."<br>";
	echo"Color: ".$profile->getFavColor()."<br>";
	echo"Games Played:";
	$games = $profile->getGamesList();
	for($k = 0; $k < count($games);$k++)
		echo $games[$k]. " ";
	echo "<br>";
	if($_GET['user'] == $_SESSION['userName'])
		echo"<br><a href=\"myprofile.php\">Edit Your Profile</a><br>";
	return true;
}

function profileNotFound(){
	echo "<h1>Profile Not Found</h1>";
}

function printProfile($profile){
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
		<br>
		
		<!-- PRINT PROFILE INFORMATION -->
		<div class="container">
			<div class="col-xs-4">
			<?php echo"<br><br><img src=\"../src/img/avatar/".$profile->getAvatar()."\" style=\"max-height:200px;max-width=:200px\"class=\"img-thumbnail\"" ?><br><br>
			<p><br><h4>Games Played</h4></p>
			<?php 
			$games = $profile->getGamesList();
			for($k = 0; $k < count($games);$k++){
				if($games[$k] == "csgo")
					echo"<img src=\"../src/img/avatar/csgoavatar.png\" alt=\"Counter-Strike: Global Offensive\" width\"40px\" height=\"40px\">";
				if($games[$k] == "lol")
					echo"<img src=\"../src/img/avatar/lolavatar.png\" alt=\"League of Legends\" width\"40px\" height=\"40px\">";
				if($games[$k] == "dota")
					echo"<img src=\"../src/img/avatar/dota2avatar.png\" alt=\"Dota 2\" width\"40px\" height=\"40px\">";
			}	
				?>
			</div>
			<div class="col-xs-6">
				<div class = "page-header">
					<h1><?php echo"".$profile->getUserName()."'s Profile";
					if($_GET['user'] == $_SESSION['userName'])
						echo"<a href=\"../controllers/myprofileController.php\" type=\"button\" class=\" pull-right btn btn-success\">Edit Profile</a>";
					
					?></h1>
				</div>
				<?php 
					echo"<strong>Name:</strong> ".$profile->getFirstName()." ".$profile->getLastName()." <br>";
					echo"<strong>Email:</strong> ".$profile->getEmail()."<br>";
					echo"<strong>Phone:</strong> ".$profile->getPhone()."<br>";
					echo"<strong>Favorite Color:</strong> ".$profile->getFavColor()."<br>";
					?>
			</div>
			
		</div>
	
		<br>
	<br>
	<!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 E-Sports League, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> 
        
        </p>
      </footer>
	</div>

	
	 
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
