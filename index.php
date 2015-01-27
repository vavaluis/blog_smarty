<?php
	include('includes/connexion.inc.php');		//Inclusion de la page de connexion a la BDD
	include('includes/haut.inc.php');		//Inclusion du haut de la page
	include('includes/verif_connexion.php');		//Inclusion de la page de verif connexion
	include('includes/notifications.inc.php'); 	  //Inclusion de la page de notification
	
	$app = 3;	//On définit le nombre d'articles max par page
	$sql = "SELECT COUNT(id) FROM articles";
	$result = mysql_query($sql);
	$data = mysql_fetch_row($result);
	$total = $data[0];	//Total d'articles dans la BDD
	$nb_pages = ceil($total / $app);	//Total de page nécessaire en fonction du nombre d'article limité par page et le nombre max d'articles dans la BDD
	
	$p = (isset($_GET['p']) && $_GET['p'] && ($_GET['p'] > 0) && ($_GET['p'] <= $nb_pages)) ? $_GET['p']:1;	
	
	$debut = ($p-1) * $app;
	
	$sql = "SELECT *, a.id AS id_article FROM articles AS a INNER JOIN utilisateurs AS u ON a.user_id = u.id";
    
	//Si c'est une recherche	
	if(isset($_GET['r'])){	
		$recherche = mysql_real_escape_string($_GET['r']);
		$sql.= " WHERE titre LIKE '%$recherche%' OR texte LIKE '%$recherche%' ORDER BY date DESC LIMIT $debut,$app";
		$count = "SELECT COUNT(*) FROM articles WHERE titre LIKE '%$recherche%' OR texte LIKE '%$recherche%'";
		$result = mysql_query($count);
		$data = mysql_fetch_row($result);
		$total = $data[0];	
		$nb_pages = ceil($total / $app);
		$titreDyn = "Recherche : " .$recherche;
	}else{
		$sql.= " ORDER BY date DESC LIMIT $debut,$app";
		$titreDyn = "Dernier article ajouté :";
	}
	
	$result = mysql_query($sql);	
	
	$index = new Smarty();
	$index->assign('titre_din',$titreDyn);
	$index->assign('tab_articles',$all_data);
	$index->assign('page',$p);
	$index->assign('recherche',$recherche);
	$index->assign('nb_pages',$nb_pages);
	
	$all_data=array();
	$i = 0;
	
	//Tant qu'il y a quelque chose dans le tableau des résultats
	while ($data = mysql_fetch_array($result)) {       
		$all_data[$i]['id'] = $data['id'];		//On récupère l'id
		$all_data[$i]['user_id'] = $data['user_id'];		//On récupère l'id utilisateur
		$all_data[$i]['nom'] = $data['nom'];		//On récupère le nom de l'utilisateur
		$all_data[$i]['prenom'] = $data['prenom'];		//On récupère le prénom de l'utilisateur
		$all_data[$i]['titre'] = $data['titre'];		//On récupère le titre
		$all_data[$i]['id_article'] = $data['id_article'];		//On récupère l'id de l'article
		
		$texte = str_replace("<","&lt;",$data['texte']); 
		$all_data[$i]['texte'] = nl2br($texte);		//On récupère le texte formaté        
				
		$date_form = date("d-m-Y",$data['date']);		//On formate la date
		$all_data[$i]['date'] = $date_form;		//On récupère la date formatée
		
		if($data['date_last_modif'] != "") {
			$date_modif_form = date("d-m-Y",$data['date_last_modif']);		//On formate la date de modification si elle existe
			$all_data[$i]['date_modif'] = $date_modif_form;		//On récupère la date de modification formatée
		}
		
		if($connecte) {
			$index->assign('connecte',$connecte);
		}
		
		$i++;
	}
	
	$index->assign('tab_articles',$all_data);		//On envoie les données vers le template
	
	$index->display("template/index.tpl");
	
   	include('includes/bas.inc.php');	//inclusion du bas de la page
?>

<script>
	$(function(){
		$(".afficher-article").click(function(){
			var id = $(this).attr('data-id');
			$.get("afficher_article.php?id="+id, function(data){
				$(".container").html(data);
			});	
		});
	});
</script>