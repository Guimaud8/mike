<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<title></title>
	</head>
	<body>
		<form action="" method="post">
			<label>Marque</label><br/>
			<input type="texte" name="marque"/><br/><br/>

			<label>Modèle</label><br/>
			<input type="texte" name="modele"/><br/><br/>

			<label>Année</label><br/>
			<input type="number" name="annee"/><br/><br/>

			<label>Couleur</label><br/>
			<input type="color" name="couleur"/><br/><br/>

			<input type="submit" value="Envoyer"/>
		</form>

		<div id="message">
		</div>

		<script>
			$(function(){
				$("input[value*='Envoyer']").click(function(e) {
					e.preventDefault();

					var marquePost = $("input[name*='marque']").val();

					var modelePost = $("input[name*='modele']").val();

					var anneePost = $("input[name*='annee']").val();

					var couleurPost = $("input[name*='couleur']").val();

					$.post("read.php", {marque : marquePost, modele : modelePost, annee : anneePost, couleur : couleurPost})

					.done(function( msg ) {
						
						$( "#message" ).html(msg);
						
					})

					.fail(function( jqXHR, textStatus ) {
						alert( "Request failed: " + textStatus );
					});
				});
			});

		</script>
	</body>
</html>