<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<title></title>
	</head>
	<body>
		<div id="mike">
			<table border="1" id="table">
			</table>
		</div>
		<script>
		$(function(){
			var request = $.ajax({
			  	url: "http://jsonplaceholder.typicode.com/users",
			  	method: "GET"
			});

			request.done(function( msg ) {
				console.log(msg);
				var table = "<tr>";
				$.each(msg[0], function(index, value){
					if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){
						table += "<th>";
						table += index;
						table += "</th>";
					}
				});
				table += "</tr>";
				for(var i = 0; i < msg.length; i++){
					table += "<tr>";
					$.each(msg[i], function(index, value){
						if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){
							table += "<td>";
							if(index == "company"){
								table += value.name;
							}
							else{
								table += value;
							}
							table += "</td>";
						}
					});
					table += "</tr>";
				}
				$( "#table" ).html( table );
			});
			request.fail(function( XPDDR, data ) {
					alert( "Request failed!");
			});
		});
		</script>
	</body>
</html>