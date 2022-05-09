<?php


// On démarre une session
session_start();





if ($_POST) {
    //on doit cibler l'id_logement de l'element : 

    if (
        isset($_POST['id_logement']) && !empty($_POST['id_logement']) &&
        isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['adresse']) && !empty($_POST['adresse'])
        && isset($_POST['ville']) && !empty($_POST['ville'])
        && isset($_POST['cp']) && !empty($_POST['cp'])
        && isset($_POST['surface']) && !empty($_POST['surface'])
        && isset($_POST['prix']) && !empty($_POST['prix'])
        && isset($_POST['photo']) && !empty($_POST['photo'])
        && isset($_POST['types']) && !empty($_POST['types'])
        && isset($_POST['descriptions']) && !empty($_POST['descriptions'])
    ) {
        // On inclut la connexion à la base
        require_once('connec.php');

        // On supprimer les données envoyées

        $id_logement = strip_tags($_POST['id_logement']);
        $titre = strip_tags($_POST['titre']);
        $adresse= strip_tags($_POST['adresse']);
        $ville = strip_tags($_POST['ville']);
        $cp= strip_tags($_POST['cp']);
        $surface = strip_tags($_POST['surface']);
        $prix = strip_tags($_POST['prix']);
        $photo= strip_tags($_POST['photo']);
        $types = strip_tags($_POST['types']);
        $descriptions = strip_tags($_POST['descriptions']);
//requete de lla mise à jou 
        //  $sql = 'UPDATE `liste` SET `produit`=:produit, `prix`=:prix, `nombre`=:nombre WHERE `id_logement`=:id_logement;';

         //sql to update 
         $sql = "UPDATE `logement` SET `titre`=:titre, `adresse`=:adresse, `ville`=:ville,`cp`=:cp, `surface`=:surface,`prix`=:prix, `photo`=:photo, `types`=:types,`descriptions`=:descriptions WHERE `id_logement`=:id_logement;";
         //end sql

        $query = $db->prepare($sql);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindValue(':ville', $ville, PDO::PARAM_STR);
        $query->bindValue(':cp', $cp, PDO::PARAM_INT);
        $query->bindValue(':surface', $surface, PDO::PARAM_INT);
        $query->bindValue(':prix', $prix, PDO::PARAM_INT);
        $query->bindValue(':photo', $photo, PDO::PARAM_STR);
        $query->bindValue(':types', $types, PDO::PARAM_STR);
        $query->bindValue(':descriptions', $descriptions, PDO::PARAM_STR);

        //PARAM_INT car nombre 
        $query->execute();
//message confimation d'un ajout de produit 
        $_SESSION['message'] = "Produit modifié avec succès ";
        require_once('close.php');

        header('Location: index.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}






//
//on démarre une session : ça permet d'utilise la super globale  

    //existe et pas vide ou n'existe pas dans l'url 

    if(isset($_GET['id_logement']) && !empty($_GET['id_logement'])){
        //vérifie si id_logement existe 
        //con à la bdd 
        require_once("connec.php");
        //
        $id_logement = strip_tags($_GET['id_logement']);

        $sql = "SELECT * FROM `logement` WHERE id_logement= :id_logement ";
        //onprepare la requete et de l'id selctionné 

        $query = $db->prepare($sql); 
        //accrocher les params (id_logement)
        $query->bindValue(':id_logement', $id_logement, PDO::PARAM_INT); 

        //execution 
        $query->execute(); 

        //recuperer la donnee

        $produit = $query->fetch(); 
        //verifie si prouit existe 

        if(!$produit){

            //message erreur et redirection vers l'accueil :

            $_SESSION['erreur']= "Cet id_logement n'existe pas ";
        header('Location: index.php');
        }


    }else{
        $_SESSION['erreur']= "URL Invalide";
        header('Location: index.php'); 
    }

    //recuperer l'id_logement et verifier si existe 
    //sinon redirection vers la page d'accueil et un message : "produit n'existe pas 


//fin 


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1>Modifier un produit</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" value="<?= $produit['titre'] ?> ">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" value="<?= $produit['adresse'] ?>">

                    </div>
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville" class="form-control" value="<?= $produit['ville'] ?>">
                    </div>
                   
                    <div class="form-group">
                        <label for="cp">Code postale</label>
                        <input type="number" id="cp" name="cp" class="form-control" value="<?= $produit['cp'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="surface">Surface en m²</label>
                        <input type="number" id="surface" name="surface" class="form-control" value="<?= $produit['surface'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="ville">Prix </label>
                        <input type="number" id="prix" name="prix" class="form-control" value="<?= $produit['prix'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" class="form-control" value="<?= $produit['photo'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="types">Type</label>
                        <div>
                            <input type="radio" id="location" name="types" value="<?= $produit['types'] ?>" checked>
                            <label for="huey">Location</label>
                        </div>
                        <div>
                            <input type="radio" id="vente" name="types" value="<?= $produit['types'] ?>" checked>
                            <label for="huey">Vente</label>
                        </div>

                        <!-- <input type="text" id="types" name="types" class="form-control" value="<?= $produit['types'] ?>"> -->
                    </div>
                    <div class="form-group">
                        <label for="descriptions">Description</label>
                        <input type="text" id="descriptions" name="descriptions" class="form-control" value="<?= $produit['descriptions'] ?>">
                    </div>
                    <!--input -->
                    <input type="hidden" value="<?= $produit['id_logement'] ?>" name="id_logement">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>

</html>