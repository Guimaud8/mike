<?php
	if(isset($_POST["marque"]) && isset($_POST["modele"]) && isset($_POST["annee"]) && isset($_POST["couleur"])){
		if(!empty($_POST["marque"]) && !empty($_POST["modele"]) && !empty($_POST["annee"]) && !empty($_POST["couleur"])){
			$pdo = new PDO('mysql:host=localhost;dbname=mike', 'root', '', array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

			$resultat = $pdo -> prepare("INSERT INTO vehicule (marque, modele, annee, couleur) VALUES (:marque, :modele, :annee, :couleur) ");
			$resultat -> bindParam(':marque', $_POST['marque'], PDO::PARAM_STR);
			$resultat -> bindParam(':modele', $_POST['modele'], PDO::PARAM_STR);
			$resultat -> bindParam(':annee', $_POST['annee'], PDO::PARAM_STR);
			$resultat -> bindParam(':couleur', $_POST['couleur'], PDO::PARAM_STR);

			$resultat -> execute();
			echo "<p style='color:green'>Ok</p>";
		}
		else{
			echo "<p style='color:red'>FAIL</p>";
		}
		
	}
	else{
		echo "<p style='color:red'>FAIL</p>";
	}
