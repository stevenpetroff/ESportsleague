<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>E-Sports League</title>

    <!-- Bootstrap core CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="src/css/customstyle.css" rel="stylesheet">
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
				include_once(dirname(__FILE__)."/views/menu.php");
				showMenu('index');
			?>
      
            </div>
          </div>
        </nav>

      </div>
    </div>

<!-- PHP HERE

Index will genertate differently for registered and unregistered users.

-->
    <!-- Jumbotron
    ================================================== -->
 <div class="jumbotron blueback">
  <div class="row">
  <div class="col-sm-7 col-md-5 col-md-offset-2">
  <p><br></p>
  	<h1>E-Sports League</h1>
  	<p>E-Sports League is yours destination for competitive online gaming play.
				Register your team or join one and compete in our monthly tournaments
				on the most popular games to claim your fame and glory!</p>
  </div>
   <div class="col-sm-6 col-md-3">
    <div class="thumbnail">
      <div class="caption">
      <?php 
      	if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
	
			echo"
    		<h3>Experience Team Manager<br></h3>
	   		<h4>Create, View and challenge other teams all in one place.</h4><br><br>
    		<a class=\"btn btn-primary\" href =\"controllers/teamManagerController.php\">Team Builder</a>
    		";

		}else{
			echo"
    		<h3>Join Today!<br></h3>
	        <form role=\"form\" action=\"controllers/signupController.php\" method =\"Post\">
      	  <input type=\"text\" class=\"form-control\" name=\"userName\" placeholder=\"Username\">
    	    <br>
  			<input type=\"email\" class=\"form-control\" name=\"userProfileEmail\" placeholder=\"E-Mail\">
  			 <br>
        <button class=\"btn btn-primary pull-right\" role=\"button\" type=\"submit\" name = \"submit\" value=\"Submit\">Sign-Up!</button>
       
      	  </form>
       	 <br><br>Already Registered? <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">Login</button>
    		";
		}
      
      ?>
      
<!--         <h3>Join Today!<br></h3> -->
<!-- PHP HERE FOR REGISTRATION / LOGIN --> 
<!--         <form role="form" action="controllers/signupController.php" method ="Post"> -->
<!--         <input type="text" class="form-control" name="userName" placeholder="Username"> -->
<!--         <br> -->
<!--   		<input type="email" class="form-control" name="userProfileEmail" placeholder="E-Mail"> -->
<!--   		 <br> -->
 
<!--         <button class="btn btn-primary pull-right" role="button" type="submit" name = "submit" value="Submit">Sign-Up!</button> -->
       
<!--         </form> -->
<!--         <br><br>Already Registered? <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Login</button> -->
        
      </div>
    </div>
  </div>
  </div>
 
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        <form class="form-signin" action ="controllers/loginController.php" method="Post" role="form">
        <h2 class="form-signin-heading">Please sign in.</h2>
        <label for="loginInputUsername" class="sr-only">Username</label>
        <input type="text" id="loginInputUsername" class="form-control" placeholder="Username" name="userName" required autofocus>
       <br>
        <label for="loginInputPassword" class="sr-only">Password</label>
        <input type="password" id="loginInputPassword" class="form-control" placeholder="Password" name="userPassword" required><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name = "submit" value="Submit">Sign in</button>
      </form>
        
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="container ">

      <!-- Three columns of text below the carousel -->
       <div class = "page-header">
			<h2><br>Recent Members</h2>
		</div>
      <div class="row">
      <?php include_once(dirname(__FILE__)."/controllers/profileController.php");
					getRecentMemberProfiles();
					?>
 
     </div>
      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Games:<span class="text-muted"> LoL, Dota, CS:GO.</span></h2>
          
          <p class="lead">Play against other teams in the most popular online games. Climb the ladder and claim your top spot in our monthly online tournaments.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="src/img/lolesports.jpg" alt="Generic placeholder image">
                </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" src="src/img/lolesports.jpg" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading">Secure and fair:<span class="text-muted"> Anti-Cheat System.</span></h2>
          <p class="lead">Every game you play is guaranteed to have a fair and fun session. If you suspect a cheater, just notify an admin via the game lobby and we will take care of it!</p>
        </div>
      </div>

      <hr class="featurette-divider">
      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 E-Sports League, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> 
        
        </p>
      </footer>
	</div>
    </div><!-- /.container -->
    
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/docs.min.js"></script>
    <script>
		$("loginPopup").hide();
    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="src//js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
