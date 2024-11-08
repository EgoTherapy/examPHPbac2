<?php 
    function connexionDB() {
        $bdd = new PDO("mysql:host=localhost;dbname=CambierJeansebastienJuin2022", "root", "");
        return $bdd;
    }
?>