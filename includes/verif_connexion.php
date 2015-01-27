<?php
	if(isset($_COOKIE['sid'])) {
		$sql = "SELECT * FROM utilisateurs WHERE sid='{$_COOKIE['sid']}'";
		
		$result = mysql_query($sql);	
		$data = mysql_fetch_array($result);
		$sid_cook_bdd = $data['sid'];
		$expiration_sid_cook_bdd = $data['expiration_sid'];
		
		if($_COOKIE['sid'] == $sid_cook_bdd) {
			if(time() <= $expiration_sid_cook_bdd) {
				$connecte = true;
			}else{
				$connecte = false;
			}
		}else{
			$connecte = false;
		}
	}else{
		$connecte = false;
	}
?>