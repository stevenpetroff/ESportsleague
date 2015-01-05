<?php 


function printMyTeam($team,$roster){
?>

		<div class="container">
			<div class="col-xs-4">
			<?php echo"<br><br><img src=\"../src/img/avatar/".$team->getTeamAvatar()."\" style=\"max-height:200px;max-width=:200px\"class=\"img-thumbnail\"" ?><br><br>
			<p><br><h4></h4></p>
			<?php 
				?>
			</div>
			<div class="col-xs-6">
				<div class = "page-header">
					<h1><?php echo"Team ".$team->getTeamName();?>
					</h1>
				</div>
				<?php 
					
					echo"<strong>Team Captain:</strong>".$roster['m1']."<br>";
					for($k = 2; $k < 9; $k++){
						echo"<strong>Member ".$k." :</strong>".$roster['m'.$k]."<br>";		
					}
					?>
			</div>
			
		</div>



<?php 
}
function printMyTeamList($teams,$captains,$scrim,$myteamId){
	if(isset($captains) && isset($teams)){
		for($t = 0, $c = count($captains);$t<$c;$t++){
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
		    		<a href=\"../views/team.php?team=".$teams[$t]->getTeamName()."\" type=\"button\" class=\" pull-right btn btn-info\">Visit Team</a>";
				if($scrim == 1 && $myteamId != $teams[$t]->getTeamId() ){
		  			echo"<button type=\"button\" onclick=\"scrimSim(".$myteamId.",".$teams[$t]->getTeamId().")\" class=\"btn btn-warning pull-right\">Scrim</button>";
				}
				echo"</td>";
		echo"</tr>";
		}
	}
	}
	
}



function printManagePage($team){
?>
	<div role="tabpanel" class="tab-pane" id="manage">
		<h3>Invite Players to Team</h3>

			
			<div class="form-group col-lg-4 has-feedback" id="userNameDiv">
		    <label class="control-label" for="userName">Invite Player by Name</label>
		    <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter Player's username" aria-describedby="unameFailGlyph">
		  	</div><br>	
		  	<div class="alert alert-danger col-lg-2" id="userNotExist"role="alert">
        		User does not Exist.     		
      	  	</div>
      	  	<div class="alert alert-warning col-lg-3" id="userNotFree"role="alert">
        		User is not a Free Agent.     		
      	  	</div>
      	  	<div class="alert alert-success col-lg-3" id="userSuccess"role="alert">
        		User was successfully invited!    		
      	  	</div>
      	  	<div class="" id="inviteUser">
        		<button type="button" onclick="inviteUser()"class="btn btn-success">Invite User to Team</button> 		
      	  	</div>
		  </div>
	</div>

	
	<script>
		$("#userNotExist").hide();
		$("#userSuccess").hide();
		$("#userNotFree").hide();
		$("#inviteUser").hide();
		var un;
		$(document).ready(function () {
		   $("#userName").keyup(verifyFreeAgent);
		});
		function inviteUser(){
			var obj = new Object();
			obj.userName = $("#userName").val();
			obj.ntype = 1;
			obj.nvalue = <?php echo $team->getTeamId()?>;
			obj.nmsg = "You have been invited to join a team!";
			$.ajax({type:"POST",
				url:"../controllers/notificationJSONController.php",
				data: {json :JSON.stringify(obj)},
				dataType: 'json',
				success: function(result){
					$("#inviteUser").hide();
					$("#userSuccess").show();
					un = $("#userName").val();
						},
				error: function(){
						alert('failed to download json string');}
			});
		}
		
		function verifyFreeAgent(){
			$("#userSuccess").hide();
			 if($("#userName").val().length > 0 && un != $("#userName").val())
					$.ajax({type:"POST",
							url:"../controllers/inviteJSONController.php",
							data: $(this).serialize(),
							dataType: 'json',
							success: function(result){
										var obj = jQuery.parseJSON(JSON.stringify(result));
										if(obj.exists == true){
											//username exists
											$("#userNotExist").hide();
											if(obj.free == true){
												//user is a free agent
												$("#userNotExist").hide();
												$("#userNotFree").hide();
												$("#inviteUser").show();
											}else if(obj.free == false){
												//user is not a free agent
												$("#userNotFree").show();
												$("#userNotExist").hide();	
												$("#inviteUser").hide();
											}
										} else {
											//username does not exist
											$("#inviteUser").hide();
											$("#userNotFree").hide();
											$("#userNotExist").show();	
										}
									},
							error: function(){
									alert('failed to download json string');}
					});
		}
	</script>

<?php
}








?>