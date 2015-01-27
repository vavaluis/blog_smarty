<?php
	include('includes/connexion.inc.php');		//Inclusion de la page de connexion a la BDD
	include('verif_connexion.php');		//Inclusion de la page de verif connexion
	include('includes/haut.inc.php');		//Inclusion du haut de la page
	include('includes/notifications.inc.php'); 		//Inclusion de la page de notification
	
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$sql = "SELECT * FROM articles WHERE id=$id";
		$req = mysql_query($sql);
		
		while($data = mysql_fetch_array($req)) {
			echo "<H3>" . $data['titre'] . "</H3>";
			echo "<p>" . nl2br($data['texte']) . "</p><BR>";
		}
	}
	
	include('includes/bas.inc.php');		//Inclusion du bas de la page
?>