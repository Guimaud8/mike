<!--
    http://jsonplaceholder.typicode.com/users

    Afficher un tableau avec :
        - Name
        - Username
        - Email
        - Phone
        - Company Name
-->


<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div>
        <table border="1" id="table"></table>
        <!-- Tableau contenant tout les utilisateurs -->
    </div>
    <div id="User">
        <!-- Tableau contenant l'utilisateur selectionner -->
    </div>
    <script>
        $(function() { // START Document.ready en JQuery

                /* Request en Ajax pour récupérer les utilisateurs - Retour en Array JSON */
                $.ajax({
                    url: "http://jsonplaceholder.typicode.com/posts",
                    method: "GET",
                })


                .done(function(mike) { // En cas de reussite - on stocker les retour dans la varible Mike.

                    var table = "<tr>"; // Init variable table

                    /* First boucle : Recuperation les titre du tableau - En bouclant sur le premier element de notre reponse (mike[0]), il recuperer les key*/
                    $.each(mike[0], function(index, value) {

                        table += "<th>";
                        table += index; // Affiche la key -> index de notre object
                        table += "</th>";

                    });

                    table += "</tr>";


                    /* Second boucle : Parcour chaque ligne du tableau

                                            |id|name|  phone   |
                        Premier iteration-> |1 |Mike|0606060606|
                        Second iteration -> |2 |Bob |0101010101|

                        *Une itération désigne l'action de répéter un processus. Le calcul itératif permet l'application à des équations récursives.
                    */
                    for (var i = 0; i < mike.length; i++) {

                        table += "<tr>";


                        /* Troisième boucle : Parcour chaque colonne du tableau

                                Seconde iteration
                                          |
                        Premier iteration |
                                 |        |
                                 v        v
                            |id|name|  phone   |
                            |1 |Mike|0606060606|

                            *Une itération désigne l'action de répéter un processus. Le calcul itératif permet l'application à des équations récursives.
                        */
                        var valueId = "1";
                        $.each(mike[i], function(index, value) {
                            
                            if( index == "id"){
                                valueId = value;
                            }
                            table += '<td><a href="' + valueId + '">';
                            table += value;
                            table += "</a></td>";  
                        });
                        table += "</tr>";
                    };
                    $("#table").html(table); // Affiche le tableau dans la balise qui a pour id "table"

                    $("a").click(function(e) { // Evenement Jquery - Evenement qui se declanche au click d'un balise "a" - variable e stocke l'evenement

                        // Annulation de l'actualisation de la page'
                        e.preventDefault();
                        var nameUser = $(this).attr('href');

                        console.log(nameUser);

                        var request = $.ajax({
                            url: 'http://jsonplaceholder.typicode.com/comments?postId=' + nameUser,
                            method: "GET",
                        });
                        request.done(function(mike) {
                            newTable = "";
                            for (var i = 0; i < mike.length; i++) {
                                console.log()
                                if (mike[i].postId == nameUser) {
                                    newTable += "<table border='1'><tr>";
                                    $.each(mike[i], function(index, value) {

                                        newTable += "<td>";
                                        newTable += value;
                                        newTable += "</td>";
                                    });

                                    newTable += "</tr></table>";
                                }
                            }

                            $("#User").html(newTable);
                        })

                    });
                })

                .fail(function(XPDDR, data) {
                    alert("Request fail !")
                })


            }) // END Document.ready en JQuery
    </script>

</body>


</html>