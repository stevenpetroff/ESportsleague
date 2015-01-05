<?php 
include_once(dirname(__FILE__)."/../controllers/profileController.php");


if(basename($_SERVER['PHP_SELF']) == "memberlist.php"){
	printMemberList();
}
function printMemberProfileList($myProfiles){
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
	//print_r($myProfiles);
	if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
		foreach($myProfiles as $profile){
			$avatar= $profile->getAvatar();
			$username = $profile->getUserName();
			echo"<div class=\"col-sm-3\">";
			echo "<img  src=\"../src/img/avatar/$avatar\" width=\"100\" height=\"100\" alt=\"avatar\"> <br>";
			echo "<a href=\"../views/profile.php?user=$username\"><h4>$username</h4></a> <br>";
			echo"</div>";
		}
	} else {
		echo"<div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>Heads up!
						</strong> To view member profiles you need to be logged in.";
		echo"</div>";
		foreach($myProfiles as $aprofile){
				$avatar= $aprofile->getAvatar();
				$username = $aprofile->getUserName();
				echo"<div class=\"col-sm-3\">";
				echo "<img  src=\"../src/img/avatar/$avatar\" width=\"140\" height=\"140\" alt=\"avatar\"class=\"img-rounded\"> <br>";
				echo "<h4>$username</h4>";
				echo"</div>";
							
		}
	}
}

function printMemberList(){
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
			<h1><br>Member List</h1>
		</div>
		<?php 
	
		?>
		<div class="row">
			<?php 
				getAllProfiles();
			?>
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