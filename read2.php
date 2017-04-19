<?php
	header("Access-Control-Allow-Origin: *");

	if(isset($_POST["requet"]) && isset($_POST["data"])){
		if(!empty($_POST["requet"]) && !empty($_POST["data"])){
			$pdo = new PDO('mysql:host=localhost;dbname=' . $_POST["data"], 'root', '', array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			));

			$resultat = $pdo -> prepare($_POST["requet"]);
			$resultat -> execute();

			// sleep(10);
			// var_dump($utilisateurs);
			$tableau = '<div>
				<div>
					<p>Requete : <span id="requet"></span></p>
					<p>Nombre de lignes : <span id="lignes">' . $resultat -> rowCount() . '</span></p>
				</div>
			<div>
				<table border="1">
					<tr>';
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

			$tableau .= '</table></div></div>';

			echo $tableau;
		}
	}

