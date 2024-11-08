<?php 
    require 'bdd.php';

    if(isset($_POST['nom'])) {
        $bdd = connexionDB();

        $requete = $bdd->prepare('insert into serie_questions(id_serie_questions, nom_serie_questions)
            select coalesce(max(id_serie_questions) + 1, 1), :nom from serie_questions;');
        $requete->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $requete->execute();

        echo($_POST["nom"]);
    }
?>