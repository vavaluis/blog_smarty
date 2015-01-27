<?php
	include('includes/notifications.inc.php');		//Inclusion de la page des notifications
	
	setcookie("sid",$sid,time()-1);
	
	session_unset ();
	session_destroy ();
	
	$_SESSION['connexion'] = 'deconnexion';
	header("location: index.php?p=1");
?>