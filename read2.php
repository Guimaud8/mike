<?php
	header("Access-Control-Allow-Origin: *");

	$retour = array("erreur" => true);

	if(isset($_POST["requet"]) && isset($_POST["data"])){
		if(!empty($_POST["requet"]) && !empty($_POST["data"])){
			$pdo = new PDO('mysql:host=localhost;dbname=' . $_POST["data"], 'root', '',);

			$resultat = $pdo -> prepare($_POST["requet"]);
			if ($resultat -> execute()){
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

				$retour["erreur"] = false;
				$retour["message"] = $tableau;
			}
			else{
				$retour["message"] = $pdo -> errorInfo()[2];
			}
		}
		else{
			$retour["message"] = "Parametre vide!"; // Gestion erreur if EMPTY variable POST
		}
	}
	else{
		$retour["message"] = "Parametre manquant!"; // Gestion erreur if isset variable POST
	}

	echo json_encode($retour);

