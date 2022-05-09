<?php
    try{
        //connexion à la bdd 
        $db= new PDO("mysql:host=localhost; dbname=immobilier", "root", "");
        //var_dump($db);
        $db->exec("SET NAMES 'UTF8' ");
       // echo 'connexion réussie';  

    }catch(PDOException $e){
        //message erreur dans la page de navigation 
        echo "Erreur : ".$e->getMessage();
        die(); 
    }