<?php

?>
<html>
<body>
<div id='inscription_form'>

			<form id='form_inscription' method="post" action='' name='inscription'>

				<p><div id='dnom'><input type='text' name='nom' placeholder='nom' required='required'/></div></p>

				<p><div id='dprenom'><input type='text' name='prenom' placeholder='prénom' required='required'/></div></p>

				<p><div id='dmail'><input type='email' name='mail' placeholder='addresse mail' required='required'/></div></p>

				<p><div id='didentifiant'><input type='text' name='identifiant' placeholder='identifiant' required='required'/></div></p>

				<p><div id='dmdp'><input type='password' name='mdp' placeholder='mot de passe' required='required'/></div></p>

				<p><div id='dmdp_conf'><input type='password' name='mdp_conf' placeholder='confirmation mot de passe' required='required'/></div></p>
				<p><div id="Qsecrete">Quel est votre lieu de naissance ?</div></p>
				<p><div id="Rsecrete"><input type="text" name="reponseSecrete" placeholder="reponse secrete" required="required"/></div></p>
				<p><center><input type='submit' onclick='verifChamps()' name='envoie' value='confirmer'/></center></p>

			</form>

		</div>
</body>	
</html>		
