<?php
$croix = '<a href="#" id="croix" class="cacher_notif">&times</a>';
if(isset($_SESSION['article'])){
	switch ($_SESSION['article']) {
		case 'ajouter':
			echo "<div class='alert alert-success'>$croix Votre article a bien été ajouté </div>";
			$_SESSION['article'] = "";
			break;
		case 'modifier':
			echo  "<div class='alert alert-success'>$croix L'article a été modifié </div>";
			$_SESSION['article'] = "";
			break;
		case 'erreur':
			echo  "<div class='alert alert-danger'>$croix Erreur, veuillez réessayer ! </div>";
			$_SESSION['article'] = "";
			break;
		case 'invalide':
			echo  "<div class='alert alert-warning'>$croix Titre ou texte manquant ! </div>";
			$_SESSION['article'] = "";
			break;
		case 'supprimer':
			echo  "<div class='alert alert-success'>$croix L'article a bien été supprimé </div>";
			$_SESSION['article'] = "";
			break;
		default:
			# code...
			break;
	}
}

if(isset($_SESSION['connexion'])){
	switch ($_SESSION['connexion']) {
		case 'connecter':
			echo "<div class='alert alert-success'>$croix Connexion réussi ! </div>";
			$_SESSION['connexion'] = "";
			break;
		case 'deconnexion':
			echo "<div class='alert alert-success'>$croix Vous êtes déconnecté ! </div>";
			$_SESSION['connexion'] = "";
			break;
		case 'invalide':
			echo  "<div class='alert alert-error'>$croix Email ou mot de passe incorrect ! </div>";
			$_SESSION['connexion'] = "";
			break;
		case 'erreur':
			echo  "<div class='alert alert-danger'>$croix Erreur 404 !</div>";
			$_SESSION['connexion'] = "";
			break;
		default:
			# code...
			break;
	}
}

if(isset($_SESSION['inscription'])){
	switch ($_SESSION['inscription']) {
		case 'inscrit':
			echo "<div class='alert alert-success'>$croix Inscription réussie ! </div>";
			$_SESSION['inscription'] = "";
			break;
		case 'manqueinfo':
			echo "<div class='alert alert-error'>$croix Veuillez renseigner tous les champs ! </div>";
			$_SESSION['inscription'] = "";
			break;
		case 'mdpincorrect':
			echo  "<div class='alert alert-error'>$croix Les mots de passe ne correspondent pas ! </div>";
			$_SESSION['inscription'] = "";
			break;
		case 'erreur':
			echo  "<div class='alert alert-danger'>$croix Erreur 404 !</div>";
			$_SESSION['inscription'] = "";
			break;
		default:
			# code...
			break;
	}
}

?>