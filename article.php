<?php
	include('includes/connexion.inc.php');	
	include('includes/haut.inc.php');
	
	if($connecte) {
		if(isset($_POST['titre'])){
			$titre = $_POST['titre'];
			$titre = mysql_real_escape_string($titre);
			$texte = $_POST['texte'];
			$texte = mysql_real_escape_string($texte);
			
			if(($titre != "") && ($texte != "")) {
				if(isset($_POST['id']) && $_POST['id']) {
					$id = $_POST['id'];		
					$sql = "UPDATE articles SET titre='$titre', texte='$texte', date_last_modif=UNIX_TIMESTAMP() WHERE id='$id'";						
					$_SESSION['article'] = 'modifier';
				} else {
					$user_id = $_SESSION['user_id'];
					$sql = "INSERT INTO articles VALUES ('','$titre','$texte',UNIX_TIMESTAMP(),'','$user_id')"; 
					$_SESSION['article'] = 'ajouter';
				}
				
				$result = mysql_query($sql);	
				
				header('location: index.php');
			} else {
				$_SESSION['article'] = 'invalide';
			}
		} else {	
			if(isset($_GET['id'])) {
				$id = (int)$_GET['id'];			
				$sql = "SELECT * FROM articles WHERE id = $id";
				$result = mysql_query($sql);
				$data = mysql_fetch_array($result);
				$titre = $data['titre'];
				$texte = $data['texte'];
				$nom_btn = 'Modifier';			
			} else {
				$titre = '';
				$texte = '';
				$id = '';
				$nom_btn = 'Valider';
			}

			?>
			
			<form action="article.php" method="post">
				<div class="clearfix">
					<label for="titre">Titre :</label>
					<div class="input"><input type="text" name="titre" id="titre" value="<?php echo $titre; ?>"></div>
				</div>
				
				<BR>
				   
				<div class="clearfix">
					<label for="texte">Texte :</label>
					<div class="input"><textarea name="texte" id="texte"><?php echo $texte; ?></textarea></div>
				</div>	
				
				<BR>
				
				<div class="form-actions">
					<input type="submit" value="<?php echo $nom_btn; ?>" class="btn btn-large btn-primary">
				</div>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
			</form>
			
			<?php	
		}
	}else{
		echo "Veuillez vous connecter pour accéder a cette page !";
		header ("Refresh: 4;URL=connexion.php");
	}

	include('includes/bas.inc.php');
?>