<?php
	session_start();
	if($_SESSION['verifConnexion'] != 1){
		header("Location:index.php");
	}
?>
<html>

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style/style-pageAdm.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>

	<header class="top">
        <nav class="navigation container">
            <a href="#" class="logo">EASY TEST</a>
		
			<ul class="nav-right">
	
				
				<form action='' method='post'>
					<input type="submit" id="bdeconnexion" name="deco" value="Déconnexion"/>
				</form>
					 
			</ul>
			

		</nav>
	</header>

	<div id='conteneurFond'>
		
		<center><h3> Panneau Administrateur</h3></center>

		<!--permet d'ajouter un utilisateur manuellement a la base de donnee-->	
		<div  id='ajoutUtilisiteur'>
			<center>Ajouter un utilisateur</center></tr><br>
			<form method='post'>
				<p><input type='text' name='nom' placeholder='Nom'/></p>
				<p><input type='text' name='prenom' placeholder='Prenom'/></p>
				<p><input type='text' name='identifiant' placeholder='Identifiant'/></p>
				<p><input type='text' name='mdp' placeholder='mot de passe'/></p>
				<p><input type='email' name='mail' placeholder='mail'/></p>
				<p><center><input class="formAdm"  type='submit' name='valider1' placeholder='valider'/></center></p>
			</form>
		</div>
		
		<!--permet de modifier le compte d'un utilisateur (mot de passe, mail ou autre)-->		
		<div  id='modifUtilisateur'>
			<center>Modifier un mot de passe</center>
			<br><br><br>
			<form method='post'>
				<p><input style='text' name='mail2' placeholder="Mail de l'utilisateur"/></p>
				<p><input style='text' name='old_mdp' placeholder="Ancien mot de passe"/></p>
				<p><input style='text' name='new_mdp' placeholder="Nouveau mot de passe"/></p>	
				<p><center><input class="formAdm"   type='submit' name='valider4' placeholder='valider'/></center></p>
			</form>
		</div>
		
		<!--permet de supprimer un utilisateur de la base de donnees-->
		<div  id='supprUtilisateur'>
			<center>Supprimer un utilisateur</center>
			<br><br><br>
			<form method='post'>
				<p><input type='text' name='nom1' placeholder='Mail'/></p>
				<br>
				<p><center><input class="formAdm" type='submit' name='valider2' placeholder='valider'/></center></p>
			</form>
		</div>	
	</div>
	
</body>
</html>
<?php
	
	$serveur = "localhost";
	$login = "root";
	$mdp = "";
	$base = "projet";
	$connexion = mysqli_connect($serveur,$login,$mdp,$base);
	
	$bd = mysqli_select_db($connexion,$base);
	
	if(isset($_POST["valider1"])){
		$requete = "SELECT mail FROM utilisateurs where mail ='".$_POST['mail']."'";
		$resultat = mysqli_query($connexion,$requete);
		$ligne = mysqli_fetch_row($resultat);
			
		if ($ligne[0] != $_POST['mail']){	
			$reqinsert = "INSERT INTO utilisateurs ";
			$reqinsert.= "values('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['identifiant']."','".$_POST['mail']."','".sha1($_POST['mdp'])."')";
			$resultat = mysqli_query($connexion,$reqinsert);
			echo '<script type="texte/JavaScript"> alert("Utilisateur crée");</script>';
		}
		else{
			echo '<script type="texte/JavaScript"> alert("Utilisateur déjà dans la base de donnée");</script>';
		}
	}
	
	if(isset($_POST["valider4"])){
		$requete = "SELECT password FROM utilisateurs where mail ='".$_POST['mail2']."' and password='".sha1($_POST['old_mdp'])."'";
		$resultat = mysqli_query($connexion,$requete);
		$ligne = mysqli_fetch_row($resultat);
		
		if($_POST['old_mdp'] == $ligne[0]){
			$reqmodif = "UPDATE Utilisateurs set password ='".sha1($_POST['new_mdp'])."' where mail = '".$_POST['mail2']."'";
			$resultat = mysqli_query($connexion,$reqmodif);
			echo '<script type="texte/JavaScript"> alert("Mot de passe modifié");</script>';
		}	
	}
	
	if(isset($_POST["valider2"]) && !empty($_POST['nom1'])){
		$reqdel = "DELETE FROM utilisateurs ";
		$reqdel.= "WHERE mail ='".$_POST['nom1']."'";
		mysqli_query($connexion,$reqdel);
	
		echo '<script type="texte/JavaScript"> alert("Utilisateur supprimé");</script>';
			
	}
			
		if(isset($_POST['deco'])){		//bouton deconnexion
			session_destroy();
			header("Location:index.php");
		}		

	mysqli_close($connexion);

?>
	 <div id='tableUtilisateur'>
                        <center>Table des utilisateurs</center><br><br>
                        <table>
                                <tr>
                                        <td>Nom</td>
                                        <td>Prénom</td>
                                        <td>Identifiant</td>
                                        <td>Mail</td>
                                        <td>Mot de passe</td>
                                </tr>
                        
               

<?php 

	$serveur = "localhost";
        $login = "root";
        $mdp = "";
        $base = "projet";
        $connexion = mysqli_connect($serveur,$login,$mdp,$base);

        $bd = mysqli_select_db($connexion,$base);

	$tout = mysqli_query($connexion,"SELECT * FROM utilisateurs");
	
	while($user = mysqli_fetch_row($tout)){
?>
	
	<tr>
		<td> <?php echo $user[0] ; ?> </td>
		<td> <?php echo $user[1] ; ?> </td>
		<td> <?php echo $user[2] ; ?> </td>
		<td> <?php echo $user[3] ; ?> </td>
		<td> <?php echo $user[4] ; ?> </td>
	</tr>
	
	<?php
	}
?>
	</table>	
	</div>
