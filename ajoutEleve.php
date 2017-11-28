<?php
	session_start();
	// if($_SESSION['verifConnexion'] != 1){
		// header("Location:connexion.php");
	// }
?>

<html>
<head>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="style/style-ajoutEleve.css"/>
</head>

<body>

	<div id="boutonAM">
		<button id="ajout" name="ajout" title="ajouter une liste d'élève" onclick="ajout()">Créer</button>
		<button id="import" name="import" title="importer une liste d'élève" onclick="import()">Import</button>
		<button name="modif" title="modifier une liste existante" onclick="modif()">Modification</button>
		<button name="visus" title="visualiser le contenue d'une liste" onclick="visualisation()">Visualiser</button>
	</div>
	
	<!--fenetre modale (pop up interne) pour renseigner une nouvelle liste d'éléve-->
	<div id="myModal" class="modal">
		<!--contenu de la fenetre modale-->
		<div class="modalContent">
			<span id="closeA" class="close">&times;</span>
			<center>
			<table id="tableCreation" width=90%>
				<tr>
					<td colspan=3><h3>Etudiants</h3></td>
				</tr>
				<tr>
					<td>Nom</td>
					<td>Prénom</td>
					<td>Identifiant (facultatif)</td>
				</tr>
				<tr height=95%>
					<td><input name="nom1" placeholder="nom de l'étudiant" style="width:100%"/></td>
					<td><input name="prenom1" placeholder="prénom de l'étudiant" style="width:100%"/></td>
					<td><input name="id1" placeholder="identifiant de l'étudiant" style="width:100%"/></td>
				</tr>
			</table>
			<button id="nouveauxEleveListe" title="ajouter un étudiant à la liste" onclick="ajoutEtuListe()">+</button>
			</center>
		</div>
	</div>
	<!--noircie le fond quand fenetre modale est affichée-->
	<div id="noirFondModal"></div>
	
	
	
	<div id="listeExistante">
		<table id="tableListeExistante" height=98% width=98%>
			<tr>
				<td colspan=4><h3>Listes Existantes</h3></td>
			</tr>
			<tr>
				<td width=20%>Création</td>
				<td width=43%>Nom</td>
				<td width=17%>Nombre d'étudiants</td>
				<td width=20%>Dernière utilisation</td>
			</tr>
			<!--ligne pour completer la table-->
			<tr height=95%>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	
	<script type="text/javascript">
		var nombreLigneAjout=2
		
		//vérifie si le tableau liste existante est vide
		var ligneTableau = document.getElementById("tableListeExistante").rows;
		if(ligneTableau[2].cells[0].innerHTML == ""){
			ligneTableau[2].innerHTML = "<td colspan=4 style='background-color:#D8D8D8;'><p>Aucune liste enregistrée<br><br></p><p>Appuyer sur le bouton Créer pour enregistrer une liste d'étudiants<br>ou<br>Appuyer sur le bouton Import pour importer une liste</p></td>";
		}
		
		//ajout d'une liste d'étudiant au tableau
		function ajout(){
			var modal = document.getElementById("myModal");
			var span = document.getElementById("closeA");
			var fond = document.getElementById("noirFondModal");
			
			modal.style.display = "block";
			fond.style.display="block";
			
			span.onclick = function(){
				modal.style.display = "none";
				fond.style.display = "none";
			}
		}
		
		function ajoutEtuListe(){
			var table= document.getElementById("tableCreation");
			
			var texte="<tr>";
			texte += "<td><input name='nom"+nombreLigneAjout+"' placeholder='nom de l etudiant' style='width:100%;'/></td>";
			texte += "<td><input name='prenom"+nombreLigneAjout+"' placeholder='prénom de l etudiant' style='width:100%;'/></td>";
			texte += "<td><input name='id"+nombreLigneAjout+"' placeholder='identifiant de l etudiant' style='width:100%;'/></td>";
			texte += "</tr>";
			
			table.innerHTML += texte;
		}
		
	</script>
	
</body>
</html>











