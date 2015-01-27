<?php
	include('includes/connexion.inc.php');
	
	$id= (int)$_GET['id'];
	$sql = "DELETE FROM articles WHERE id = $id";
	
	mysql_query($sql);
	
	$_SESSION['article'] = 'supprimer';
	header('location: index.php?p=1');
?>