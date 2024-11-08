<html>
    <?php require 'Index.php';?>
    <body>
        <form id="ajoutSerie" method="post">
            <h1>Création d'une série de questions</h1>
            <label>Nom série : </label><br/>
            <input type="text" name="nom"/><br/><br/>
            <input type="submit" value="Ajouter série"/>
        </form>

        <form id="ajoutQuestion" method="post">
            <h2>Création des questions</h2>
            <label>Série : </label><br/>
            <select name="serie">
            </select><br/>

            <label>Question : </label><br/>
            <input type="text" name="question"/><br/>

            <label>Choix 1 :</label><br/>
            <select name="choix1" class="choix">
            </select><br/>

            <label>Choix 2 :</label><br/>
            <select name="choix2" class="choix">
            </select><br/>

            <label>Choix 3 :</label><br/>
            <select name="choix3" class="choix">
            </select><br/>

            <label>Réponse : </label><br/>
            <select name="reponse">
            </select><br/><br/>
            <input type="submit" value="Ajouter question"/>
        </form>
    </body>
    <script>
        $(document).ready(function() {
            //Ajout des séries dans le select des séries
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
            //Ajout des choix dans les select
            $.get("code.txt", function(data) {    
                var lines = data.split("\n");
                $.each(lines, function(n, elem) {
                    $(".choix").append('<option>' + elem + '</option>');
                });
            });
            //Ajout des réponses dans le select dés qu'on change une des propositions
            $(".choix").change(function() {
                console.log("test");
                $("select[name='reponse']").empty();
                $("select[name='reponse']").append("<option>" + $("select[name='choix1']").val() + "</option>");
                $("select[name='reponse']").append("<option>" + $("select[name='choix2']").val() + "</option>");
                $("select[name='reponse']").append("<option>" + $("select[name='choix3']").val() + "</option>");
            });
            //Ajout d'une série dans la BD
            $("#ajoutSerie").submit(function() {
                var data = $(this).serialize();
                $.ajax({
                    url : "InsertSerie.php",
                    type : "post",
                    data : data
                });
            });
            //Ajout d'une question dans la BD
            $("#ajoutQuestion").submit(function() {
                var data = $(this).serialize();
                $.ajax({
                    url : "InsertQuestion.php",
                    type : "post",
                    data : data
                });
            });
        });
    </script>
</html>