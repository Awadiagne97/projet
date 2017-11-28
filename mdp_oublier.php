<html>
<head>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<body style="background-image:"./images/fond-test3.jpg">


 <header class="top">
        <nav class="navigation container">
            <a href="index.php" class="logo">EASY TEST</a>
            
        </nav>
    </header>




<div class="container">
<div class="account-page">
<div class="form">


	 <h1> Mot de Passe oublié</h1>

	<form method="post" >
		<p><input type="email" name="mail" placeholder="Adresse mail" required="required"/></p>
		<p><input type="text" name ="oldmdp" placeholder="Ancien mot de passe" required="required"/></p>
		<p><input type="password" name="newmdp" placeholder="Nouveau mot de passe" required="required"/></p>
		<button type='submit' name='validr' value='Envoyer'/>Confirmer </button>
	
	</form>

</div>
</div>
</div>
</body>

</html>
<?php


	$serveur="localhost";
		$login="root";
		$mdp="";

		$connexion = mysqli_connect($serveur,$login,$mdp);

		$base = "projet";
		
	if(isset($_POST["valider"])){

	
		
		mysqli_select_db($connexion,$base);				
			
		$req = "SELECT password FROM utilisateurs WHERE mail = '".$_POST['mail']."'";		
		
		$resultat = mysqli_query($connexion,$req);
		$ligne = mysqli_fetch_row($resultat);
	

		if($_POST['oldmdp'] == $ligne[0]){

			$update = "UPDATE utilisateurs SET password ='".sha1($_POST['mdp'])."' WHERE mail='".$_POST['mail']."'";

			$resultat = mysqli_query($connexion,$update);
			header('Location:index.php');
			}
		else{
			
			
			echo "Mauvaise de passe Incorrecte !";}
		
	}
mysqli_close($connexion);

?>
