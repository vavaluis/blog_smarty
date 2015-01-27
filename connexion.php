<?php
	include('includes/connexion.inc.php');		//Inclusion de la page de connexion a la BDD
	
	if(isset($_POST['email']) && isset($_POST['mdp'])){

		//Récupère et sécurise l'email
		$email = $_POST['email'];
		$email = mysql_real_escape_string($email);	
		
		//Récupère et sécurise le mdp
		$mdp = $_POST['mdp'];
		$mdp = mysql_real_escape_string($mdp);	
		
		$sql = "SELECT * FROM utilisateurs";	
		$result = mysql_query($sql);	
		
		while($data = mysql_fetch_array($result)) {
			if($email == $data['email']) {
				if($mdp == $data['mdp']) {
					echo "Connection OK" ;
					$sid = md5($email.time());
					$expiration_sid = time()+1800;
					$sql = "UPDATE utilisateurs SET sid='$sid', expiration_sid='$expiration_sid' WHERE email='$email'";
					$result = mysql_query($sql);	//recupere le resultat de la requete
					setcookie("sid",$sid,time()+1800);
					$_SESSION['connexion'] = 'connecter';
					$_SESSION['user_id'] = $data['id'];
					header("location: index.php?p=1");
				}else{
					//Mot de passe incorrect
					$_SESSION['connexion'] = 'invalide';
					header("location: connexion.php");
				}
			}else{
				//Identifiant incorrect
				$_SESSION['connexion'] = 'invalide';
				header("location: connexion.php");
			}
		}	
	}else{	
		include('includes/haut.inc.php');		//Inclusion du haut de la page
		include('includes/notifications.inc.php');		//Inclusion de la page de notification
		?>
			<h2>Connexion</h2>
			
			<p>Saisissez les identifiants choisis lors de votre connexion</p>
			
			<form action="connexion.php" method="post" id="form_connexion">
				<BR>
				<fieldset>
					<div class="clearfix">
						<div class="input"><input id="email" name="email" size="30" type="email" value="" placeholder="Email" /></div>
					</div>
					<div class="clearfix">
						<div class="input"><input id="mdp" name="mdp" size="15" type="password" placeholder="Mot de passe"/></div>
					</div>							
					<div class="form-actions">
						<input class="btn btn-large btn-primary" id="submit" type="submit" value="Se connecter" />
					</div>
				</fieldset>
			</form>
		<?php
	}
	
	include('includes/bas.inc.php');		//Inclusion du bas de la page	
?>