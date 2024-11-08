<?php 
    require 'bdd.php';

    $bdd = connexionDB();
    $requete = $bdd->prepare('select * from serie_questions;');
    $requete->execute();

    $result = $requete->fetchAll(PDO::FETCH_ASSOC);
    echo utf8_encode(json_encode($result)); 
?>