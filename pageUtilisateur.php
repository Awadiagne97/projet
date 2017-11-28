<?php
	//verifie que l'utilisateur s'est connecter par la page index.php (page d'acceuil)
	session_start();
	if($_SESSION['verifConnexion'] != 1){
		header("Location:index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
    <title>EASY TEST </title>
    <link rel="stylesheet" href="style/style-pageUser.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>

    <header class="top">
        <nav class="navigation container">
            <a href="index.php" class="logo">EASY TEST</a>
            <ul class="nav-right">
	
				
				<form action='' method='post'>
					<input type="submit" id="bdeconnexion" name="deco" value="Déconnexion"/>
				</form>
					 <li><a href="aide/aidePageUtilisateur.html">Aide</a></li>
						<li><a href="pageCompte.php">Compte</a></li>
						 <li><a href="correction.php">Correction</a></li>
			</ul>
		</nav>
    </header>
	<!--menu en haut de page contenant les boutons deconnexion, aide et compte-->
		<fieldset>
			<legend> QCM </legend>
			<h3>Question 1</h3>
			<form action ="" method="post" name="question1" id="formulaire">
				<p><input id="intitule" type="textarea" name="intituleQ1" placeholder="intitulé de la question"/></p>
				<p><input type="checkbox" name="r11"  id="check1"/> <label for="check1" > </label> <input id="reponse" type="text" name="rt11" placeholder="premiére réponse"/></p>
				<p><input type="checkbox" name="r21" id="check2" /> <label for="check2" > </label> <input id="reponse" type="text" name="rt12" placeholder="seconde réponse"/> </p>
				<p><input type="checkbox" name="r31" id="check3" /> <label for="check3" > </label> <input id="reponse" type="text" name="rt13" placeholder="troisiéme réponse"/> </p>
				<p><input type="checkbox" name="r41" id="check4"  /> <label for="check4" > </label> <input id="reponse" type="text" name="rt14" placeholder="quatriéme réponse"/> </p>
		</fieldset></br> </br></br>
		
				<button type="submit" name="valider" value="valider" id="validerBBas"> Valider </button>
				<input type='button' onclick='ajout_question()' name='ajouter' value='Ajouter une question' id='ajoutBBas'/> 
				<input type='button' onclick='retirer_question()' name='retirer' value='Supprimer une question' id='retirerBBas' />
	<div id="BBas">
		<center>
			<!--<input type="text" name="nomQuestionnaire" placeholder="nom du questionnaire" id="nomQuestionnaire"/ required> ||-->
			
		<form>
			
			<label > <strong> Date de l'examen </strong> </label>
			<div class="champsExam" >
				<input type='number'  id='jourBBas' name="jourBBas" step="any" min="1" max="31"/ required> 
				<input type='number' id='MoisBBas'/ name="MoisBBas" step="any" min="1" max="12"required> 
				<input type='number'  id='anBBas'/ name="anBBas" required> 
			</div></br>
			<label for="exemplaireBBas" > <strong>Nombre d'exemplaire </strong></label>
			<input type="number" name="nbExemplaire"  id='exemplaireBBas' step="any" min="1" max="100"/ required> </br></br>
			<label > <strong>Durée</strong> </label></br>
			
				<label for="heureBBas" > Heure</label>
				
					<input type='number'   id='heureBBas' name='heureBBas' step="any" min="1" max="3" > 
			
				<label for="minutesBBas"> Minutes </label>
				
					<input type='number'  id='minutesBBas' name='minuteBBas' step="any" min="0" max="60"/> 
				</div>
		

			<input type='text' name="nombreExemplaireTotal" id='nombreDExemplaireTotal' value='1' style='display:none'/>	<!--input cach� pour donner les nb totale de question-->
			<input type='text' name="nomQuestionnaire" placeholder="nom du questionnaire" id="nomQuestionnaire"/ required>   <!-- TITRE DU QUESTIONNAIRE -->
		</form>
		</center>
	</div>
	


	<script type="text/javascript"> //v�rifie que le navigateur est Chrome || sinon change l'input date en texte
		var navigateur = window.navigator.userAgent;
		if(navigateur.match("Chrome") != "Chrome") {
			document.getElementById("dateBBas").type='text';
			document.getElementById("dateBBas").placeholder='date (jj/mm/aaaa)';
		}
	</script>
	
	<?php
		if(isset($_POST["valider"])){		//r�cup�rer et envoyer les variables � la page traitement_QCM.php
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			
			$serveur = "localhost";
		        $login = "root";
       			$mdp = "projet";
        		$base = "";
        		$connexion = mysqli_connect($serveur,$login,$mdp,$base);

        		$bd = mysqli_select_db($connexion,$base);


			$_SESSION['nbExemplaire'] = $_POST['nbExemplaire'];
			$_SESSION['nbTotalQuestion'] = $_POST['nombreExemplaireTotal'];	
			$_SESSION['jour'] = $_POST['jourBBas'];	
			$_SESSION['Mois'] = $_POST['MoisBBas'];	
			$_SESSION['an'] = $_POST['anBBas'];	
			$_SESSION['duree'] = ($_POST['heureBBas'] * 60) + $_POST['minuteBBas'];
			$_SESSION['nomQuestionnaire'] = $_POST['nomQuestionnaire'];
			
			for($i = 1;$i<$_POST['nombreExemplaireTotal']+1;$i++){
				$temp = 'intitule'.$i;
				$temp2 = 'intituleQ'.$i;
				$_SESSION[$temp] = $_POST[$temp2];
				
				for($y=1;$y<5;$y++){
					$temp = 'parRep'.$i.$y;
					$temp2 = 'rt'.$i.$y;
					$_SESSION[$temp] = $_POST[$temp2];
					
					$tmp = 'check'.$i.$y;
					$tmp2 = 'r'.$y.$i;
					$_SESSION[$tmp] = $_POST[$tmp2];
					
					$tmp3 = 'coef'.$i.$y; 
					$_SESSION["bar".$i.$y] = $_POST[$tmp3];
				}
			}
			 $today = date("d/m/y");
			 $reqinsert = "INSERT INTO sujets ";
	                 $reqinsert.= "values('".$_SESSION['mail']."','".$today."','".$_SESSION['date']."','".$_SESSION['duree']."','".$_SESSION['nbExemplaire']."','".$_SESSION['nomQuestionnaire']."')";
                        $resultat = mysqli_query($connexion,$reqinsert);
			
			
			header('Location:traitement_QCM.php');
		}
		
		if(isset($_POST['deco'])){		//bouton deconnexion
			session_destroy();
			header("Location:index.php");
		}		
	?>
	
	
	
	<script type="text/javascript">
		var compteur = 2;
		var rajout;
		var compteurBBas = true;
		var memoireQuestion = [];
		
		//nombre de question du QCM
		var nbQuestionPrompt = window.prompt("nombre de question du QCM");
		for(i=0;i<nbQuestionPrompt-1;i++){
			ajout_question();
		}
		
		function ecriture(){
			rajout = "";
			rajout += '<div id="ques'+compteur+'"><br>';
			rajout += '<h3>Question '+compteur+'</h3>';
			rajout += "<form action ='' method ='post' name='question"+compteur+"'>";
			rajout += "<p><input id='intitule' type='textarea' name='intituleQ"+compteur+"' placeholder='intitulé de la question'/></p>";
			rajout += "<p><input type='checkbox' name='r1"+compteur+"' id='check1a'//> <label for='check1a'> </label><input id='reponse' type='text' name='rt"+compteur+"1' placeholder='premiére réponse'/> </p>";
			rajout += "<p><input type='checkbox' name='r2"+compteur+"' id='check2a'//>  <label for='check2a'> </label> <input id='reponse' type='text' name='rt"+compteur+"2' placeholder='seconde réponse'/></p>";
			rajout += "<p><input type='checkbox' name='r3"+compteur+"' id='check3a'//>  <label for='check3a'> </label> <input id='reponse' type='text' name='rt"+compteur+"3' placeholder='troisiéme réponse'/> </p>";
			rajout += "<p><input type='checkbox' name='r4"+compteur+"' id='check4a'//>  <label for='check4a'> </label> <input id='reponse' type='text' name='rt"+compteur+"4' placeholder='quatriéme réponse'/> </p>";
			rajout += "</form>"
		}
		
		function sauvEntrer(){ //garde en m�moire les champs remplis par l'utilisateur
			i = 0;
			for (i = 0; i < 9*(compteur-1) ; i++){
				memoireQuestion[i] = document.getElementById("formulaire").elements[i].value;
				
				// A CORRIGER POUR CHECKBOX
				//if(i%2 = 1 and i%9 != 0){
				//	if(document.getElementById("formulaire").elements[i].checked = true){
				//		memoireQuestion[i] = 'checked';
				//	}
				//}
			}
		}
		
		function ecritureEntrer(){ //r�ecrit les champs remplit par l'utilisateur
			for (i=0;i<9*(compteur-1);i++){
				document.getElementById("formulaire").elements[i].value = memoireQuestion[i];
			}
			memoireQuestion = [];
		}
		
		function ajout_question(){
			sauvEntrer();
			ecriture();
			document.getElementById('formulaire').innerHTML += rajout;
			ecritureEntrer();
			compteur++;
			document.getElementById('nombreDExemplaireTotal').value=compteur-1;
		}
		
		function retirer_question(){
			if(compteur>2){
				compteur--;
				var objAsupp = document.getElementById("ques"+compteur);
				objAsupp.parentNode.removeChild(objAsupp);
				document.getElementById('nombreDExemplaireTotal').value=compteur-1;
			}
			else{
				alert("Suppression impossible !");
			}
		}
		
		function cacherBBas(){
			if (compteurBBas == true){
				document.getElementById("cacheBBas").style = "background-image:url('images/fleche-Haut.jpg');";
				document.getElementById("BBas").style.display = "none";
				document.getElementById("cacheBBas").style.bottom = "100px";				
				compteurBBas = !compteurBBas;
			}
			else if (compteurBBas == false){
				document.getElementById("cacheBBas").style = "background-image:url('images/fleche-Bas.jpg');";
				document.getElementById("BBas").style.display = "block";
				document.getElementById("cacheBBas").style.bottom = "100px";				
				compteurBBas = !compteurBBas;
			}
		}
		
		function versPageAide(){
			document.location.href="aide/aidePageUtilisateur.html";
		}
		
		function versPageCompte(){
			document.location.href="pageCompte.php";
		}
		function versPageCorrection(){
			document.location.href="correction.php";
		}
		
	</script>


</body>
</html>
















