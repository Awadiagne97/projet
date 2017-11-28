<?php

	session_start();


?>
<html>
<body>
<html lang="en">
<body >
<head>
    <meta charset="UTF-8">
    <title>EASY | Connexion</title></br>
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
                <h1>Connexion</h1>

                <form class='form_inscription' method="post" action="" name="connexion">
                    <input type="text" name="mail" placeholder="login" />
                    <input type="password" name="pwd" placeholder="Mot de passe" />
                    <button type="submit" name="boutonLog" value="connexion" >Connexion</button>
                    <p class="message">Pas Inscrit ? <a href="inscription.php">Inscrivez vous!</a></p>
                </form>
				<a href="mdp_oublier.php" style="position:absolute;right:10px;">mot de passe oublié</a>
            </div>
        </div>
    </div>



	
	
	
	
	
    <footer class="footer">
        <div class="container">
            <p><small>&copy; Université de Versailles Saint Quentin en Yvelines 2017 France</small></p>
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



if(isset($_POST['boutonLog'])){

		if($_POST['mail'] == "admin" && $_POST['pwd'] == "admin" && !empty($_POST['pwd']) && !empty($_POST['mail'])){

			$_SESSION['verifConnexion'] = 1;

			header('Location:pageAdm.php');

		}

		//Verifie si personne est dans la base de donnée	

		$requete = "SELECT mail,password FROM utilisateurs where mail ='".$_POST['mail']."' and password='".sha1($_POST['pwd'])."'";

		$resultat = mysqli_query($connexion,$requete);

		$ligne = mysqli_fetch_row($resultat);

		

		if ($_POST['mail'] == $ligne[0] && sha1($_POST['pwd']) == $ligne[1] && !empty($_POST['mail']) && !empty($_POST['pwd']) ){

			$_SESSION['mail'] = $_POST['mail'];

			$_SESSION['verifConnexion'] = 1;			

			header('Location:pageUtilisateur.php');

		}

	}	



?>