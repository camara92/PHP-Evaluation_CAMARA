<?php
// On démarre une session
session_start();

if ($_POST) {
    if (
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

        // On nettoie les données envoyées
        $titre = strip_tags($_POST['titre']);
        $adresse = strip_tags($_POST['adresse']);
        $ville = strip_tags($_POST['ville']);
        $cp = strip_tags($_POST['cp']);
        $surface = strip_tags($_POST['surface']);
        $prix = strip_tags($_POST['prix']);
        $photo = strip_tags($_POST['photo']);
        $types = strip_tags($_POST['types']);
        $descriptions = strip_tags($_POST['descriptions']);
        //inertion 
        $sql = 'INSERT INTO `logement` (`titre`, `adresse`, `ville`,`cp`, `surface`,`prix`, `photo`, `types`,`descriptions`) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :types, :descriptions);';

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
        $_SESSION['message'] = "Produit ajouté";
        require_once('close.php');

        header('Location: index.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

//upload image 
//ENVOI DE FICHIERS PHP
if(isset($_FILES['photo']) && $_FILES['photo']['error'] ==0){  //la photo existe et a été stockée temporairement sur le serveur

	if ($_FILES['photo']['size']<= 3000000){ //photo fait moins de 3MO

		$informationsImage = pathinfo($_FILES['photo']['name']);
		$extensionImage = $informationsImage['extension'];
		$extensionsArray = array('png', 'gif', 'jpg', 'jpeg', 'webp'); //extensions qu'on autorise

		if(in_array($extensionImage, $extensionsArray)){  

			move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/images/'.time().basename($_FILES['photo']['name'])); // on renomme notre photo avec une clé unique suivie du nom du fichier

        echo 'Envoi bien réussi !' ;

        }
	}
}

//end uploads 

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body >
    <main class="container bg-info">
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
                <h1>Ajouter un produit</h1>
                <form action="add.php" method="post" class="bg-light text-center" width="">
                    <div class="form-group">
                        <label for="titre">Titre du logement</label>
                        <input types="text" id="produit" name="titre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse </label>
                        <input types="text" id="adresse" name="adresse" class="form-control" required>

                    </div>
                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input types="text" id="ville" name="ville" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cp">Code postale</label>
                        <input types="number" id="cp" name="cp" required minlength="5" maxlength="5" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="surface">Surface en m²</label>
                        <input type="number" id="surface" name="surface" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" required>

                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Type : </label>
                        <!-- <label for="type">Type de logement </label>
                        <input type="radio" id="type" name="type" class="form-control"> -->
                        <!-- <div> -->
                            <input type="radio" id="location" name="types" value="location" checked>
                            <label for="huey">Location</label>
                        <!-- </div>
                        <div> -->
                            <input type="radio" id="vente" name="types" value="Vente" checked>
                            <label for="huey">Vente</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="descriptions">Descriptions</label>
                        <input type="text" id="descriptions" name="descriptions" class="form-control">

                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>

</html>