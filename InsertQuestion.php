<?php 
    require 'bdd.php';

    if(isset($_POST['serie']) && isset($_POST['question']) && isset($_POST['choix1']) && isset($_POST['choix2'])
        && isset($_POST['choix3']) && isset($_POST['reponse'])) {

        $bdd = connexionDB();
        $requete = $bdd->prepare('insert into question(id_question, question, choix1, choix2, choix3, reponse,
            id_serie_questions) select coalesce(max(id_question) + 1, 1), :question, :choix1, :choix2, 
            :choix3, :reponse, :id_serie from question;');

        $requete->bindValue(':question', $_POST['question'], PDO::PARAM_STR);
        $requete->bindValue(':choix1', $_POST['choix1'], PDO::PARAM_STR);
        $requete->bindValue(':choix2', $_POST['choix2'], PDO::PARAM_STR);
        $requete->bindValue(':choix3', $_POST['choix3'], PDO::PARAM_STR);
        $requete->bindValue(':reponse', $_POST['reponse'], PDO::PARAM_STR);
        $requete->bindValue(':id_serie', $_POST['serie'], PDO::PARAM_INT);

        $requete->execute();
    }
?>