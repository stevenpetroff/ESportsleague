<?php 
include_once(dirname(__FILE__)."/../controllers/loginController.php");
include_once(dirname(__FILE__)."/../views/login.php");



if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

function printTeamManager($team,$profile,$teamsList,$captains,$roster,$userType,$myteamId){
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
    <link href="../src/css/teammanager.css" rel="stylesheet">
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
		
		<!-- Begin Team Manager -->
		<div class="container">
			<div >
				<h2><br><br>Team Manager</h2>
				 <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			  <?php if($userType == 11 || $userType == 10)
			  			echo"<li role=\"presentation\" class=\"active\"><a href=\"#myteam\" aria-controls=\"myteam\" role=\"tab\" data-toggle=\"tab\">My Team</a></li>";
			  		else 
			  			echo"<li role=\"presentation\" class=\"active\"><a href=\"#info\" aria-controls=\"info\" role=\"tab\" data-toggle=\"tab\">Information</a></li>";?>
			  		
			    <!--  <li role="presentation" class="active"><a href="#myteam" aria-controls="myteam" role="tab" data-toggle="tab">My Team</a></li>
			    -->
			    <li role="presentation"><a href="#teamlist" aria-controls="teamlist" role="tab" data-toggle="tab">Team List</a></li>
			    <!-- <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">Schedule</a></li>-->
			    <?php     
			    		if($userType == 11){
							echo "<li role=\"presentation\"><a href=\"#manage\" aria-controls=\"manage\" role=\"tab\" data-toggle=\"tab\">Manage</a></li>";
						}
			    ?>
			  </ul>
			</div>
			<div class="container">
			<div role="tabpanel">
			  <!-- Tab panes -->
			  <div class="tab-content">
			 <?php if($userType == 11 || $userType == 10){
			  	echo"<div role=\"tabpanel\" class=\"tab-pane active\" id=\"myteam\">";
			  	printMyTeam($team,$roster);
				echo"</div>";
			  	} else{
					echo"<div role=\"tabpanel\" class=\"tab-pane active\" id=\"info\">";
						echo"<h1 class=\"text-center\">Hello there!<br></h1>";
						echo"<h4 class=\"text-center\">It looks like you are not currently on a team. This means you have limited access to our Team Manager.<br>";
						echo"To get started, you can create a team by selecting the Team Builder button below,<br> or browse the current teams by clicking on the \"Team List\" tab above.</h4>";
						echo"<div class=\"col-md-12 text-center\"> ";
						echo"<a href=\"../controllers/teamBuilderController.php\" type=\"button\" class=\" btn btn-lg btn-primary\">Team Builder</a></div>";
					echo"</div>";
				}?>
				  <div role="tabpanel" class="tab-pane" id="teamlist">
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
							<tbody>
						    	<?php $scrim = 0; if($userType == 11) $scrim =1; printMyTeamList($teamsList,$captains,$scrim,$myteamId);?>
						    </tbody>
						</table>
					</div>	   
			    </div>
			    <!--  	<div role="tabpanel" class="tab-pane" id="schedule">3..</div>-->
			    		<?php 
			    		if($userType == 11){
			    			printManagePage($profile);
			    		}
			    		
			    		?>
			    		
			    
			  </div>
				</div>
			</div>
			
			
		</div>
	
		<br>
	<br>
	<!-- FOOTER -->
      <footer class="footer">
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
    <script>

    function scrimSim(myTeam,theirTeam){
		var obj = new Object();
		obj.myTeam = myTeam;
		obj.theirTeam = theirTeam;
		$.ajax({type:"POST",
			url:"../controllers/scrimSimulationController.php",
			data: {json :JSON.stringify(obj)},
			dataType: 'json',
			success: function(result){
					var obj = jQuery.parseJSON(JSON.stringify(result));
					alert(obj.result);
					window.location.reload();
					},
			error: function(){
					alert('failed to download json string');}
		});
		
	}

    </script>
  </body>
</html>
<?php 
}
?>
