<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>E-Sports League</title>
</head>
<body>
	<header>
		<h1>E-Sports League!</h1>
		<img src="src/img/logo.png" alt="logo">
	</header>
	<section>
		<div class="menuBar">
			<br />
			<h3>Menu</h3>	
			<?php 
				include_once(dirname(__FILE__)."/views/menu.php");
				showMenu();
			?>
		</div>
	</section>
	<br>

	<section>
		<div id="orgDescription">
			<h4>What is E-Sports League?</h4>
			<aside>
				E-Sports League is your destination for competitive online gaming play.<br>
				Register your team or join one and compete in our monthly tournaments<br>
				on the most popular games to claim your fame and glory!
				
			</aside>
		</div>
	</section>

	<br>
	<br>
	<fieldset>
		<legend>Recent Members</legend>
		<div id="recentMembers">
				<?php
					include_once(dirname(__FILE__)."/controllers/profileController.php");
					getRecentMemberProfiles();
				?>
			
		</div>
	</fieldset>
	<br>

	<footer>

		<br> (c) E-Sports League 2014-2014.
	</footer>
</body>
</html>
