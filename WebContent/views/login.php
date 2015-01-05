<?php 

function loginForm($user,$error){
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
	<?php 
	if($error == "unauthenticated"){
		echo"<br><br><div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>Heads up!
						</strong> To view member profiles you need to be logged in.";
		echo"</div>";
	}
	if($error == "invalidusername"){
		echo"<br><br><div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>
						</strong> The Username you have entered is invalid.";
		echo"</div>";
	}
	if($error == "invalidpassword"){
		echo"<br><br><div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>Heads up!
						</strong> The password you have entered is invalid.";
		echo"</div>";
	}
	if($error == "teambuilderunauthenticated"){
		echo"<br><br><div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>Heads up!
						</strong> To create a team, you must be logged in.";
		echo"</div>";
	}
	if($error == "teamlistunauthenticated"){
		echo"<br><br><div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>Heads up!
						</strong> To view teams, you must be logged in.";
		echo"</div>";
	}
	if($error == "tmunauthenticated"){
		echo"<br><br><div class=\"alert alert-danger\" role=\"alert\">";
		echo"<strong>Heads up!
						</strong> To view the Team Manager you need to be logged in.";
		echo"</div>";
	}
	?>
		
		<div class="row">
		<div class = "page-header">
			<h2 class="text-center">Please Sign in</h2>
		</div>
			<form class="form-signin" action ="../controllers/loginController.php" method="Post" role="form">
	        <label for="loginInputUsername" class="sr-only">Username</label>
	        <input type="text" id="loginInputUsername" class="form-control" placeholder="Username" name="userName" required autofocus>
	       <br>
	        <label for="loginInputPassword" class="sr-only">Password</label>
	        <input type="password" id="loginInputPassword" class="form-control" placeholder="Password" name="userPassword" required><br>
	        <button class="btn btn-lg btn-primary btn-block" type="submit" name = "submit" value="Submit">Sign in</button>
	      </form>
	      <h4 class="text-center"><a href="../controllers/signupController.php">Don't have an account?</a></h4>
	      
		</div>
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