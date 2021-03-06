<?php
// On démarre une session
session_start();

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id_logement']) && !empty($_GET['id_logement'])){
    require_once('connec.php');

    // On nettoie l'id envoyé
    $id_logement = strip_tags($_GET['id_logement']);

    $sql = 'SELECT * FROM `logement` WHERE `id_logement` = :id_logement;';
    //une requête sur l'id et prepare puis execution et à la fin requete de supression de la donnée selon l'id selectionnée
    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id_logement', $id_logement, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
        die();
    }

    $sql = 'DELETE FROM `logement` WHERE `id_logement` =:id_logement;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id_logement', $id_logement, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Produit supprimé";
    header('Location: index.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}