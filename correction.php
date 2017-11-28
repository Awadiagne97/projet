<head>
   <meta charset="UTF-8">
    <title>EASY | CORRECTION</title>
    <link rel="stylesheet" href="style/style.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

</head>


<body  background="images/fondQCM.jpg";background-repeat="no-repeat";>




<body>

    <header class="top">
        <nav class="navigation container">
            <a href="#" class="logo">EASY TEST</a>
       
        </nav>
    </header>





<form class="form" method="post" enctype="multipart/form-data">
    Nom du QCM à corriger : <input type="text" name="QCMcorrec"/>
    <input type="file" name="files[]" id="files" multiple="">
    <input id="Upbutton" type="submit" name ="b" value="Upload" />
</form>
</body>
<?php
	session_start();

	exec ("chmod -R g+rwx www-data /home/groupe4/Fichiers/qcm001-RSX-groupeB"); 
	
	if(isset($_POST['b'])){
    		foreach ($_FILES['files']['name'] as $i => $name) {	
            			move_uploaded_file($_FILES['files']['tmp_name'][$i], "/home/groupe4/Fichiers/".$_SESSION['mail']."/".$_POST['QCMcorrec']."/scans/".$name); 
            					
        		}
    		
	
	
	exec("auto-multiple-choice analyse /home/groupe4/Fichiers/".$_SESSION['mail']."/".$_POST['QCMcorrec']."/ /home/groupe4/Fichiers/".$_SESSION['mail']."/".$nomQCM."/scans/*");

	exec("auto-multiple-choice export --data /home/groupe4/Fichiers/".$_SESSION['mail']."/".$_POST['QCMcorrec']."/data -- module ods --fich-noms students-list.csv --o output-note.ods");

        header('Content-Type: application/force-download');

        header('Content-Disposition: attachment; filename="output-note.ods"');
        readfile("/home/groupe4/Fichiers/".$_SESSION['mail']."/".$_POST['QCMcorrec']."/output-note.ods");
	 }
?>
