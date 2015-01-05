<?php

include_once(dirname(__FILE__)."/../controllers/loginController.php");
include_once(dirname(__FILE__)."/../views/login.php");
include_once (dirname(__FILE__)."/../views/error.php");

function printNotifications($notifications){
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
		<div class="page-header">
		<br>
		<h1>Notifications</h1>
		</div>
		
		<?php 
			if(!is_null($notifications) && !empty($notifications))
			foreach($notifications as $note){
				$type = $note->getNType();
				$val = $note->getNValue();
				if($type == 1){
					$type = "Team Invite";
					$team = teamDB::getTeamById($val);
					$userId = $note->getUserId();
					$teamId = $team->getTeamId();
					$val = $team->getTeamName();
				}
				echo"<div class =\"col-md-4\">
	  					<div class=\"panel panel-primary\">
							<div class=\"panel-heading\">
								<h3 class=\"panel-title\">".$type."</h3>
							</div>
							<div class=\"panel-body\">
								You have been invited to join Team ".$val."
			    				<br>
    							<br>
			    				<button type=\"button\" id =\"invaccept\" class=\"btn btn-success\"onclick=\"respondInvite(1,".$userId.",".$teamId.")\">Accept <span class=\"glyphicon glyphicon-ok\"></span></button>
			    				<button type=\"button\" id =\"invdecline\" class=\"btn btn-danger\"onclick=\"respondInvite(0,-1,-1)\">Decline <span class=\"glyphicon glyphicon-remove\"></span></button>
							</div>
						</div>
    				</div>";
			}
			else 
				echo"<h3>You currently have no notifications.</h3>";
		?>
		
		
	</div>
	
		<br>
	<br>
	<!-- FOOTER -->
      <footer class="footer">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2014 E-Sports League, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a> 
        
        </p>
      </footer>


	
	 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../src//js/ie10-viewport-bug-workaround.js"></script>
    
    <script>
	function respondInvite(status,userId,val){
		var obj = new Object();
		obj.status = status;
		obj.userId = userId;
		obj.val = val;
		$.ajax({type:"POST",
			url:"../controllers/notificationJSONController.php",
			data: {json :JSON.stringify(obj)},
			dataType: 'json',
			success: function(result){
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