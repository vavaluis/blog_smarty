<?php 
	include('includes/connexion.inc.php');	
	
	$nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
	$prenom = mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
	$email_insc = mysql_real_escape_string(htmlspecialchars($_POST['email_insc']));

	
	if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email_insc']) && !empty($_POST['mdp']))
	{
		//Je sécurise les données

		$mdp = mysql_real_escape_string(htmlspecialchars($_POST['mdp']));
		$mdp2 = mysql_real_escape_string(htmlspecialchars($_POST['mdp2']));
		
		if($mdp == $mdp2)
		{
			// Cryptage du mot de passe
			// $mdp = sha1($mdp);

			mysql_query("INSERT INTO utilisateurs VALUES('', '$nom', '$prenom', '$email_insc', '$mdp', '', '')");
			$_SESSION['inscription'] = 'inscrit';
			header("location: index.php?p=1");
			
			unset($_SESSION['nom']);
			unset($_SESSION['prenom']);
			unset($_SESSION['email_insc']);
		} else {
			//Mot de passe incorrect
			$_SESSION['nom'] = $nom;
			$_SESSION['prenom'] = $prenom;
			$_SESSION['email_insc'] = $email_insc;
			$_SESSION['inscription'] = 'mdpincorrect';
			header("location: inscription.php");
		}
	} else {
		include('includes/haut.inc.php');		//Inclusion du haut de la page
		include('includes/notifications.inc.php');		//Inclusion de la page de notification

		//Champs manquants
		$_SESSION['inscription'] = 'manqueinfo';
		
		if(!empty($_POST['nom'])){
			$_SESSION['nom'] = $nom;
		}
		if(!empty($_POST['prenom'])){
			$_SESSION['prenom'] = $prenom;
		}
		if(!empty($_POST['email_insc'])){
			$_SESSION['email_insc'] = $email_insc;
		}
	?>
		<h2>Inscription</h2>
			
		<p>Saissisez les identifiants qui vous permettront de vous connecter sur le blog :</p>
	
		<form action="inscription.php" method="post" id="form_inscription">
			<BR>
		
			<div class="clearfix">
				<div class="input"><input type="text" name="nom" id="nom" placeholder="Nom" value="<?php if(isset($_SESSION['nom'])) echo $_SESSION['nom'] ?>"></div>
			</div>
				   
			<div class="clearfix">
				<div class="input"><input type="text" name="prenom" id="prenom" placeholder="Prénom" value="<?php if(isset($_SESSION['prenom'])) echo $_SESSION['prenom'] ?>"></div>
			</div>	
		
			<div class="clearfix">
				<div class="input"><input type="email" name="email_insc" id="email_insc" placeholder="Email" value="<?php if(isset($_SESSION['email_insc'])) echo $_SESSION['email_insc'] ?>"></div>
			</div>
	
			<BR>
	
			<div class="clearfix">
				<div class="input"><input id="mdp" name="mdp" type="password" placeholder="Mot de passe"/></div>
			</div>
		
			<div class="clearfix">
				<div class="input"><input id="mdp2" name="mdp2" type="password" placeholder="Mot de passe verification"/></div>
			</div>
		
			<div class="form-actions">
				<input type="submit" value="Valider" class="btn btn-large btn-primary">
			</div>
		</form>
	
<?php 
	}
	
	include('includes/bas.inc.php'); 
?>