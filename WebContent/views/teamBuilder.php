<?php 
function teamBuilder($newTeam){
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
			<h1><br>Team Builder</h1>
		</div>
		<div class="alert alert-info" role="alert">
        	<strong>Team Builder Alert:</strong> All fields are required!<br>     		
      	</div>
<!-- 
	INCLUDE PHP HERE FOR ERROR MESSAGES 
-->  
      	<p class="lead">Team Information</p>
      	
		<form role="form" action="../controllers/teamBuilderController.php" enctype="multipart/form-data" method ="Post">
		<div class = "row">
		  <div class="form-group col-lg-4 has-feedback" id="teamNameDiv">
		    <label for="teamName">Team Name</label>
		    <input type="text" class="form-control" id="teamName" name="teamName"placeholder="Team Name"
		    <?php if (!is_null($newTeam) && !empty($newTeam->getTeamName())) {echo 'value = "'. $newTeam->getTeamName() .'"';}?>>
		  </div>
		  <br>
		  		  <div class="alert alert-danger col-lg-3" id="teamnameValidate"role="alert">
        		This team name is already taken.      		
      	  	</div>
		</div>
		<div class = "row">
		  <div class="form-group col-lg-4">
		    <label class="control-label" for="teamGame">What game is this team for?</label>
		    <br><input type="radio" name="teamGame"  value="1" tabindex="13">CS:GO<br>
		    <input type="radio" name="teamGame"  value="2" tabindex="13">League of Legends<br> 
		    <input type="radio" name="teamGame"  value="3" tabindex="13">DOTA2<br>  
		  </div>
		</div>
		
		
		<div class = "row">
		  <div class="form-group col-lg-4">
		    <label class="control-label" for="teamColor">Team Color</label>
		    <input type="color" class="form-control" id="teamColor" name="teamColor" >
		  </div>
		</div>
		 <div class="form-group">
		  <label for="teamAvatar">Choose your avatar</label>
		  <br><img src="../src/img/avatar/csgoavatar.png" alt="Counter-Strike:Global Offensive" width="50" height="50">
			<input type="radio" name="teamAvatar" class="avatar" value="csgoavatar.png" ><br> 
				<img src="../src/img/avatar/lolavatar.png" alt="League of Legends" width="50" height="50"> 
			<input type="radio" name="teamAvatar" class="avatar" value="lolavatar.png" ><br> 
				<img src="../src/img/avatar/dota2avatar.png" alt="Dota 2" width="50" height="50">
			<input type="radio" name="teamAvatar" class="avatar" value="dota2avatar.png" ><br>
	
			<i>Or upload your own. </i> <br> 
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
		    <input type="file" name ="teamAvatar">   
		  </div>
		  <button type="submit" id="formSubmit" name="submit" value="Submit" class="btn btn-default">Submit</button>
		</form>
	</div>	 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../src/js/bootstrap.min.js"></script>
    <script src="../src/js/docs.min.js"></script>
    <script>
	$("#teamnameValidate").hide();
	$(document).ready(function () {
	//$("#teamName").keyup(verifyPassword);
		});

	function verifyPassword(){
		if($("#teamName").val().length > 0)
			$.ajax({type:"POST",
					url:"../controllers/jsonPostController.php",
					data: $(this).serialize(),
					dataType: 'json',
					success: function(result){
								var obj = jQuery.parseJSON(JSON.stringify(result));
								//console.log(obj.exists);
								if(obj.exists == false){
									//alert(JSON.stringify(result));
									$("#teamNameDiv").removeClass("has-error");
									$("#teamNameDiv").addClass("has-success");
									
									$("#teamnameValidate").hide();
									$("#formSubmit").prop('disabled', false);
									$("#formSubmit").prop('enabled', true);
								} else {
									//alert(JSON.stringify(result));
									$("#teamNameDiv").addClass("has-error");
									$("#teamNameDiv").removeClass("has-success");
									
									$("#teamnameValidate").show();
									$("#formSubmit").prop('disabled', true);
								}
							},
					error: function(){
							alert('failed to download json string');}
			});
	   else {
		   $("#teamNameDiv").removeClass("has-success");
			$("#teamNameDiv").removeClass("has-error");
			
			$("#teamnameValidate").hide();
			$("#formSubmit").prop('disabled', false);
			$("#formSubmit").prop('enabled', true);	   
	   }


	}


    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../src//js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php 
}
?>