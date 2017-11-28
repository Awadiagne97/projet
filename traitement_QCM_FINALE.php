<?php
	session_start();
			
		$nomQCM=$_SESSION['nomQuestionnaire'];
		exec("cp /home/groupe4/doc_base.txt /home/groupe4/".$nomQCM.".txt");
		
		///////////////////////////Variables///////////////////////////////////////////////////////////
		
		$filename=$nomQCM.".txt";	//Nom du fichier
		
		$nbExemplaire=$_SESSION['nbExemplaire'];
		$date=$_SESSION['date'];
		$duree=$_SESSION['duree'];
		$nbQuestion=$_SESSION['nbTotalQuestion'];
		
		/////////////////////////////DebutDuDocument///////////////////////////////////////////////////
		
		$exemplaire=$nbExemplaire."}{";	//exemplaire
		$dateexam=$date." ".chr(92).chr(101)."nd{minipage}
\champnom{".chr(92).chr(102)."box{
		"; //date de l'examen
		$dureeTxt=$duree." minutes."; //durée de l'examen
		
		$fichier=fopen('/home/groupe4/'.$nomQCM.'.txt','r+');	//Ouvre
			fseek ($fichier, 288);			//Position du poiteur
			fwrite($fichier, $exemplaire);	//nb exemplaire
			
			fseek ($fichier, 453);			//Position du poiteur
			fwrite($fichier, $dateexam);	//date
			
			fseek ($fichier, 737);			//Position du poiteur
			fwrite($fichier, $dureeTxt);	// duree
		
		////////////////////////////Questions/////////////////////////////////////////////////
		for ($i=0; $i<$nbQuestion; $i++){
			$y=$i+1;
			
			$intitule=$_SESSION['intitule'.$y];
			
			
			$rep1=$_SESSION['parRep'.$y.'1'];
			$rep2=$_SESSION['parRep'.$y.'2'];
			$rep3=$_SESSION['parRep'.$y.'3'];
			$rep4=$_SESSION['parRep'.$y.'4'];

			$check1=$_SESSION['check'.$y.'1'];
			$check2=$_SESSION['check'.$y.'2'];
			$check3=$_SESSION['check'.$y.'3'];
			$check4=$_SESSION['check'.$y.'4'];
			
			$checkRep1="";
			$checkRep2="";
			$checkRep3="";
			$checkRep4="";
			
			$cptRep=0;
			$nbRep="";
			
			$bar1=$_SESSION['bar'.$y.'1'];
			$bar2=$_SESSION['bar'.$y.'2'];
			$bar3=$_SESSION['bar'.$y.'3'];
			$bar4=$_SESSION['bar'.$y.'4'];
			$question="";

			if ($check1 == 'on'){
				$checkRep1="\bonne{".$rep1."}\bareme{".$bar1."}";
				$cptRep++;
			}
			else{
				$checkRep1="\mauvaise{".$rep1."}\bareme{".$bar1."}";
			}
			if ($check2 == 'on'){
				$checkRep2="\bonne{".$rep2."}\bareme{".$bar2."}";
				$cptRep++;
			}
			else{
				$checkRep2="\mauvaise{".$rep2."}\bareme{".$bar2."}";
			}
			if ($check3 == 'on'){
				$checkRep3="\bonne{".$rep3."}\bareme{".$bar3."}";
				$cptRep++;
			}
			else{
				$checkRep3="\mauvaise{".$rep3."}\bareme{".$bar3."}";
			}
			if ($check4 == 'on'){
				$checkRep4="\bonne{".$rep4."}\bareme{".$bar4."}";
				$cptRep++;
			}
			else{
				$checkRep4="\mauvaise{".$rep4."}\bareme{".$bar4."}";
			}
			
			if ($cptRep>1){
				$nbRep="\begin{questionmult}{".$y."}";
				$question="
		
".$nbRep."
	".$intitule."
	\begin{reponses}
		".$checkRep1."
		".$checkRep2."
		".$checkRep3."
		".$checkRep4."
	"
	.chr(92).chr(101)."nd{reponses}
"
.chr(92).chr(101)."nd{questionmult} ";
			}
			else{
				$nbRep="\begin{question}{".$y."}";
				$question="
		
".$nbRep."
	".$intitule."
	\begin{reponses}
		".$checkRep1."
		".$checkRep2."
		".$checkRep3."
		".$checkRep4."
	"
	.chr(92).chr(101)."nd{reponses}
"
.chr(92).chr(101)."nd{question} ";
			}
		
		fseek ($fichier, -1, SEEK_END);			//Position du poiteur
		fwrite($fichier, $question);	//  question
			
		}
	////////////////////////////////PageReponse///////////////////////////////////////////////////////
	
	$pageRep="
	\AMCcleardoublepage    

	\AMCdebutFormulaire    

	%%% début de l'en-tête de la feuille de réponses

	{\large\bf Feuille de réponses :}
	\hfill \champnom{".chr(92).chr(102)."box{    
		\begin{minipage}{.5\linewidth}
		  Nom et prénom :
		  
		  ".chr(92).chr(118)."space*{.5cm}\dotfill
		  ".chr(92).chr(118)."space*{1mm}
		".chr(92).chr(101)."nd{minipage}
	  }}

	\begin{center}
	  \bf".chr(92).chr(101)."m Les réponses aux questions sont à donner exclusivement sur cette feuille :
	  les réponses données sur les feuilles précédentes ne seront pas prises en compte.
	".chr(92).chr(101)."nd{center}

	%%% fin de l'en-tête de la feuille de réponses

	".chr(92).chr(102)."ormulaire    

	\AMCcleardoublepage

	";
	
	fseek ($fichier, -1, SEEK_END);	//Position du poiteur
	fwrite($fichier, $pageRep);	//Page de reponse
	
	////////////////////////////////FinDuDocument/////////////////////////////////////////////////////
	
		$fin="
		
%\AMCaddpagesto{3}
}
".chr(92).chr(101)."nd{document}";
		
		fseek ($fichier, -1, SEEK_END);	//Position du poiteur
		fwrite($fichier, $fin);	//fin du document
	
	////////////////////////////////FermetureDuDocument///////////////////////////////////////////
	
	fclose($fichier); //ferme fichier
	
    	exec ("cp /home/groupe4/".$nomQCM.".txt /home/groupe4/".$nomQCM.".tex");
    	exec ("rm /home/groupe4/".$nomQCM.".txt");
    
        exec ("chmod 777 /home/groupe4/".$nomQCM.".tex"); 
	exec ("auto-multiple-choice prepare --mode s --prefix /home/groupe4 /home/groupe4/".$nomQCM.".tex" );
        
        exec ("mkdir /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."");
        exec ("sh /home/groupe4/new_project.sh ".$_SESSION['mail']." ".$nomQCM."");

	exec ("mv /home/groupe4/".$nomQCM.".tex /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."");
		

	exec ("mv /home/groupe4/amc-compiled.* /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."");
    	exec ("mv /home/groupe4/".$nomQCM.".tex /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."");
    	exec ("cp /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."/amc-compiled.pdf /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."/".$nomQCM.".pdf");
    	exec ("chmod +x /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."/".$nomQCM.".pdf");

    	header('Content-Type: application/pdf');

    	header('Content-Disposition: attachment; filename="'.$nomQCM.'.pdf"');
    	readfile("/home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."/".$nomQCM.".pdf");


	?>
	
	
</html>
