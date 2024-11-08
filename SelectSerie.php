<?php 
    require 'bdd.php';

    if(isset($_POST['serie'])) {
        $bdd = connexionDB();
        $requete = $bdd->prepare('select * from serie_questions inner join question using(id_serie_questions) 
            where id_serie_questions = :id;');
        $requete->bindValue(':id', $_POST['serie'], PDO::PARAM_INT);
        $requete->execute();

        $result = $requete->fetchAll(PDO::FETCH_ASSOC);
        echo utf8_encode(json_encode($result));
    }   
?>