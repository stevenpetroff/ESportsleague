<?php 
include_once(dirname(__FILE__)."/../controllers/teamController.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../controllers/loginController.php");
include_once(dirname(__FILE__)."/../views/login.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(basename($_SERVER['PHP_SELF']) == "teamList.php"){
	if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
		if(basename($_SERVER['PHP_SELF']) == "teamList.php")
			getTeamList();
	} else{
		//echo"You must be logged in to view this profile";
		loginForm(null,"teamlistunauthenticated");
	}
}
function printTeamList($teams,$captains){
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
		<div class = "page-header">
			<h2><br>Team Viewer</h2>
		</div>
			<div id="csgoteams" class="col-lg-10">
			<table class="table table-striped table-hover">
				<thead>
				<tr>
					<th>Team Id</th>
					<th>Team Name</th>
					<th>Team Game</th>
					<th>Team Captain</th>
					<th>Team Win/Loss Ratio</th>
				</tr>
				</thead>
				<tbody><?php 
							if(isset($captains) && isset($teams)){
								for($t = 0, $c = count($captains);$t<$c;$t++){
									$game;	
									$flag =0;
									if($teams[$t]->getTeamGame() == 1)
										$game = 'CS:GO';
									if($teams[$t]->getTeamGame() == 2)
										$game = 'LoL';
									if($teams[$t]->getTeamGame() == 3)
										$game = 'Dota 2';
									if($teams[$t]->getTeamGame() == 99)
										$flag = 1;
									if($flag == 0){
										echo"<tr  class='clickableRow'>";
											echo"<td>".$teams[$t]->getTeamId()."</td>";
											echo"<td>".$teams[$t]->getTeamName()."</td>";
											echo"<td>".$game."</td>";
											echo"<td>".$captains[$t]."</td>";
											echo"<td><span class=\"text-success\">".$teams[$t]->getTeamWin()."</span> / <span class=\"text-danger\">".$teams[$t]->getTeamLoss()."</span>
    											<a href=\"../views/team.php?team=".$teams[$t]->getTeamName()."\" type=\"button\" class=\" pull-right btn btn-info\">Visit Team</a></td>";
	
										echo"</tr>";
									}
									
								}
							}
						?>
				</tbody>
			</table>
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
