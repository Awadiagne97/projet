<?php
	session_start();
	if($_SESSION['verifConnexion'] != 1){
		header("Location:index.php");
	}
?>

<html>
<head>
   <meta charset="UTF-8">
    <title>EASY | COMPTE</title>
    <link rel="stylesheet" href="style/style-pageCompte.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>

    <header class="top">
        <nav class="navigation container">
            <a href="#" class="logo"> EASY TEST</a>
            <ul class="nav-right">
			
			
				<form action='' method='post'>
					<input type="submit" id="bdeconnexion" name="deco" value="Déconnexion"/>
				</form>
					 <li><a href="aide/aidePageUtilisateur.html">Aide</a></li>
						<li><a href="pageUtilisateur.php">Création QCM</a></li>
	
				
						
			</ul>
		</nav>
    </header>


	
	<center><div id='titre'>
		<h2>Bienvenue dans la gestion de votre compte</h2>
	</div></center>
		
	<script type='text/javascript'>
		
		var boolMdp = true;
		
		function versPageUtil(){
			document.location.href = "pageUtilisateur.php";
		}

	</script>
	
</body>
</html>

<?php

        if(isset($_POST['deco'])){              //bouton deconnexion
	        session_destroy();
                header("Location:index.php");
         }


        $serveur = "localhost";
        $login = "root";
        $mdp = "";
        $base = "projet";
        $connexion = mysqli_connect($serveur,$login,$mdp,$base);

        $bd = mysqli_select_db($connexion,$base);
	
        $infoPers = mysqli_query($connexion,"SELECT * FROM utilisateurs WHERE mail='".$_SESSION['mail']."'");
	$ligne = mysqli_fetch_row($infoPers);

	$infoSujet = mysqli_query($connexion,"SELECT Date_Creation, Date_Sujet, Duree, Nombre_Exemplaire,Titre FROM sujets WHERE mail='".$_SESSION['mail']."'");
	
?>
	<div id='infoPerso'>
                <center><h3>Informations personnelles</h3></center>
                <br><br>
		<p>Nom : <?php echo $ligne[0]; ?> </p>
		<p<Prenom : <?php echo $ligne[1]; ?></p>
                <p>Identifiant : <?php echo $ligne[2]; ?> </p>
		<p>Adresse mail : <?php echo $ligne[3]; ?> </p>
                
	</div>
	
	<div id='tableSujet'>
                <center><h3>Sujets précédemment créés</h3></center>
                <br><br>
                <table>
                        <tr>
				<td><b>Titre</b></td>
                                <td><b>Date de création</b></td>
                                <td><b>Date du sujet</b></td>
                                <td><b>Durée</b></td>
                                <td><b>Nombres d'exemplaires</b></td>
                        </tr>

<?php 
	

	while($ligne2 = mysqli_fetch_row($infoSujet)){
?>
	<tr>
		<td><p><a href="download.php?titre=<?php echo $ligne2[0]; ?>"><?php echo $ligne2[0]; ?></a></p></td>
               	<td><p><?php echo $ligne2[1]; ?></p></td>
               	<td><p><?php echo $ligne2[2]; ?></p></td>
               	<td><p><?php echo $ligne2[3]; ?></p></td>
		<td><p><?php echo $ligne2[4]; ?></p></td>
	
	</tr>

	
<?php
	}
?>
	</table>

	</div>
