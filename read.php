<?php
	header("Access-Control-Allow-Origin: *");

	$pdo = new PDO('mysql:host=localhost;dbname=my', 'root', '', array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	));

	$resultat = $pdo -> prepare("SELECT * FROM utilisateurs");
	$resultat -> execute();

	// sleep(10);
	// var_dump($utilisateurs);

	$tableau = '<table><tr>';
	for($i = 0; $i < $resultat -> columnCount(); $i++){
		$meta = $resultat -> getColumnMeta($i);
		$tableau .= '<th>' . $meta['name'] . '</th>';
	}

	$tableau .='</tr>';

	while($infos = $resultat -> fetch(PDO::FETCH_ASSOC)){
		$tableau .= '<tr>';
		foreach($infos as $indice => $valeur){
			$tableau .= '<td>' . $valeur . '</td>';
		}
		$tableau .= '</tr>';
	}

	$tableau .= '</table>';

	echo $tableau;