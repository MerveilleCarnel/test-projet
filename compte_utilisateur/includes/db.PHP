<?php
    $pdo = new PDO('mysql:host=localhost;dbname=generateur;charset=utf8', 'root', '',[
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	]);

?>