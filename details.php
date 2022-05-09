<?php

//on démarre une session : ça permet d'utilise la super globale  
session_start(); 
    //existe et pas vide ou n'existe pas dans l'url 

    if(isset($_GET['id_logement']) && !empty($_GET['id_logement'])){
        //vérifie si id existe 
        //con à la bdd 
        require_once("connec.php");
        //
        $id = strip_tags($_GET['id_logement']);

        $sql = "SELECT * FROM `logement` WHERE id_logement= :id_logement ";
        //onprepare la requete 

        $query = $db->prepare($sql); 
        //accrocher les params (id)
        $query->bindValue(':id_logement', $id, PDO::PARAM_INT); 

        //execution 
        $query->execute(); 

        //recuperer la donnee

        $produit = $query->fetch(); 
        //verifie si prouit existe 

        if(!$produit){

            //message erreur et redirection vers l'accueil :

            $_SESSION['erreur']= "Cet identifiant n'existe pas ";
        header('Location: index.php');
        }


    }else{
        $_SESSION['erreur']= "URL Invalide";
        header('Location: index.php'); 
    }

    //recuperer l'id et verifier si existe 
    //sinon redirection vers la page d'accueil et un message : "produit n'existe pas 
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Details </title>
    </head>
    <body>
        <main class="container my-2">
            <div class="row border ">
                <section class="col">
                    <h1 class="text-center ">Détail du prouit : <?=$produit['titre'] ?></h1>
                    <p>ID : <?=$produit['id_logement'] ?></p>
                    <p>Titre de logement : <?=$produit['titre'] ?></p>
                    <p>Adresse du logement : <?=$produit['adresse'] ?></p>
                    <p>Ville : <?=$produit['ville'] ?></p>
                    <p>Code postale : <?=$produit['cp'] ?></p>
                    <p>Surface : <?=$produit['surface'] ?>m²</p>
                    <p>Prix : <?=$produit['prix'] ?>&euro;</p>
                    <p>Photo : <?=$produit['photo'] ?></p>
                    <p>Type : <?=$produit['types'] ?></p>
                    <p>Descriptions : <?=$produit['descriptions'] ?></p>
                    <p><a href="index.php" class="border bold border-success bg-dark text-white text-decoration-none p-2 my-4">Retour </a></p>

                 
                </section>
            </div>
        </main>
    </body>
    </html>
