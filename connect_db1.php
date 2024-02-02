<?php 
		try {
			$db = new PDO('mysql:host=localhost;dbname=generateur','root','');
			
		} catch (PDOException $e) {
			
			die('Erreur: ' .$e->getMessage());
		}





?>