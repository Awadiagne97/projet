<?php

	session_start();

	header('Content-Type: application/pdf');

        header('Content-Disposition: attachment; filename="'.$_GET['titre'].'.pdf"');
        readfile("/home/groupe4/Fichiers/".$_SESSION['mail']."/".$_GET['titre']."/".$_GET['titre'].".pdf");
	?>
