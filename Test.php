<html>
    <?php require 'Index.php';?>
    <body>
        <form id="choixSerie" method="post">
            <h1>Choix de la série</h1>
            <label>Série : </label><br/>
            <select name="serie">
            </select><br/><br/>
            <input type="submit" value="Choisir"/>
        </form>
        <form id="quizz" method="post">
        </form>
        <div id="score">
        </div>
    </body>

    <script>
        $(document).ready(function() {
            //Ajout des séries dans le select des séries
            var serie = null;
            var numQuestion = 0;
            var score = 0;
            $.ajax({
                url : "SelectSeries.php",
                type : "post",
                dataType : "json",
                success : function(series) {
                    for(serie of series) {
                        $("select[name='serie']").append("<option value=" + serie.id_serie_questions + ">" 
                            + serie.nom_serie_questions + "</option>");
                    }
                }
            });
            //Sélection de la série choisie
            $("#choixSerie").submit(function(e) {
                e.preventDefault();
                var data = $("select[name='serie']").val();
                console.log(data);
                $.ajax({
                    url : 'SelectSerie.php',
                    type : 'post',
                    data : {'serie' : data},
                    dataType : 'json',
                    success : function(serieDB) {
                        serie = serieDB;
                        if(serie.length == 0) {
                            $("#quizz").append("<h3>Aucune question trouvée pour cette série !</h3>" + 
                                "<input type='submit' value='quitter' onclick='location.reload();'/>");
                        } else {
                            afficherQuestion(serie[0]);
                        }
                    }
                });
                $("#choixSerie").hide();
            });
            //Question suivante lors du clique 
            $("#quizz").submit(function(e) {
                e.preventDefault();
                //Vérifier si la réponse est correcte
                console.log($("input[name='reponse']:checked").val() + " / " + serie[numQuestion].reponse)
                if($("input[name='reponse']:checked").val() == serie[numQuestion].reponse) {
                    score = score + 1;
                }
                //Affichage de la question suivante
                numQuestion = numQuestion + 1;
                if(numQuestion < serie.length) {
                    afficherQuestion(serie[numQuestion]);
                } else {
                    $("#quizz").hide();
                    $("#score").append("<h2>Vous avez obtenu un score de " + score + "/" + serie.length + "</h2>" + 
                        "<input type='submit' value='Retourner à la sélection' onclick='location.reload();'/>");
                }
            });

            function afficherQuestion(question) {
                $("#quizz").empty();
                $("#quizz").append("<h1>Quizz</h1>" + 
                    "<span>" + question.question + " ?</span><img src='Panneaux/" + question.reponse + ".gif' height='30' width='30'/><br/>" + 
                    "<input type='radio' name='reponse' value='" + question.choix1 + "'/><label>" + question.choix1 + "</label><br/>" +
                    "<input type='radio' name='reponse' value='" + question.choix2 + "'/><label>" + question.choix2 + "</label><br/>" +
                    "<input type='radio' name='reponse' value='" + question.choix3 + "'/><label>" + question.choix3 + "</label><br/>" +
                    "<br/><input type='submit' value='Question suivante'/>");
            }
        });
    </script>
</html>