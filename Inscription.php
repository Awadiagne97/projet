<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AMC | Inscription</title>
    <link rel="stylesheet" href="style/style-identification.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>

<body>

    <header class="top">
        <nav class="navigation container">
            <a href="index.php" class="logo">EASY TEST</a>
            <ul class="nav-right">
                <li><a href="connexion.php">Se connecter</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
            </ul>
        </nav>
    </header>


    <div class="container">
        <div class="account-page">
            <div class="form">
                <h1>Inscription</h1>

                <form class='form_inscription' method="post"  action="">
                    <div id='dnom'><input type='text' name='nom' placeholder='nom' required='required'/></div>

				<div id='dprenom'><input type='text' name='prenom' placeholder='prénom' required='required'/></div>

				<div id='dmail'><input type='email' name='mail' placeholder='addresse mail' required='required'/></div>

				<div id='didentifiant'><input type='text' name='identifiant' placeholder='identifiant' required='required'/></div>

				<div id='dmdp'><input type='password' name='mdp' placeholder='mot de passe' required='required'/></div>

				
				<button type='submit' onclick='verifChamps()' name='envoie' value='confirmer'/> Inscription </button>

				 <p class="message">Deja Inscrit ? <a href="connexion.php">Connectez vous!</a></p>
                </form>
            </div>
        </div>
    </div>



    <footer class="footer">
        <div class="container">
            <p><small>&copy; 2017 Université de Versailles Saint Quentin en Yvelines France</small></p>
        </div>
    </footer>

</body>
</html>
<?php


//Connexion à la base de donnée

	$serveur = "localhost";

	$login = "root";

	$mdp = "";



	$connexion = mysqli_connect($serveur,$login,$mdp);

	$base = "projet";

	

	$bd = mysqli_select_db($connexion,$base);




		//Ajoute utilisateur dans la base de donnee

	if(isset($_POST['envoie'])){

		mysqli_query($connexion,"INSERT INTO utilisateurs VALUES('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['identifiant']."','".$_POST['mail']."','".sha1($_POST['mdp'])."','".$_POST['reponseSecrete']."')");

	}
	
?>
