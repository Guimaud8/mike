<?php
$pdo = new PDO('mysql:host=localhost;dbname=my', 'root', '', array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			));
$resultatDatabase = $pdo -> query("SHOW DATABASES");

$database = $resultatDatabase -> fetchAll(PDO::FETCH_ASSOC);



?>


<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<title></title>
	</head>
	<body>
		<div id="mike">
			<form>
				<fieldset>
					<legend>Requete</legend>
					<label>Bdd :</label>
					<select id="databaseSelect">
						<?php foreach($database as $valeur): ?>	
							<option value="<?= $valeur['Database'] ?>"> <?= $valeur['Database'] ?> </option>
						<?php endforeach; ?>

					</select><br />
					<textarea name="sql" id="sql" rows="4" cols="50">SELECT * FROM utilisateurs</textarea><br/>
					<input type="submit" value="Envoyer" />
				</fieldset>
			</form>
		</div>
		<script>
		$(function(){
			$("input").click(function(e) {
				e.preventDefault();

				console.log("Mike");

				var myRequest = $("#sql").val();

				var dataBase = $("#databaseSelect").val();

				var request = $.ajax({
			  		url: "read2.php",
			  		method: "POST",
			  		data: {requet : myRequest, data : dataBase}
				});
			 
				request.done(function( msg ) {
					$( "#mike" ).html( msg );
					$( "#requet" ).html( myRequest );
				});
					 
				request.fail(function( jqXHR, textStatus ) {
					alert( "Request failed: " + textStatus );
				});
			});
		});
		</script>
	</body>
</html>