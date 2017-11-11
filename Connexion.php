<?php

	session_start();


?>
<html>
<body>
	<div id='login_form'>

			<form method='post' action="" name="connexion">

				<input type='text' name='mail' placeholder='login'/>

				<input type='password' name='pwd' placeholder='mot de passe'/>

				<input type='submit' name='boutonLog' value='connexion'/>

			</form>

			<a href="mdp_oublier.php" style="position:absolute;right:10px;">mot de passe oublié</a>

		</div>
</body>
</html>
