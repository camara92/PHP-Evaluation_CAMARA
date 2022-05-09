<?php
//session 

session_start();
require_once('connec.php');

$sql = ('SELECT * FROM logement ');

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$results = $query->fetchAll(PDO::FETCH_ASSOC);

//require_once('close.php');

?>
<?php require_once "partials/header.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <title>Liste de logements </title>
</head>

<body>

    <main class=" my-2">
        <div class="row">
            <section class="col-12">
                <!--message erreur -->
                <?php
                if (!empty($_SESSION['erreur'])) {

                    echo '<div class="alert alert-danger text-center" role="alert">
                        ' . $_SESSION['erreur'] . '
                      </div>';
                    $_SESSION['erreur'] = "";
                }

                ?>
                <!--message d'envoie des données vers ma base -->
                <?php
                if (!empty($_SESSION['message'])) {

                    echo '<h3><div class="alert bg-success text-center text-white bold shadow" role="alert">
                        ' . $_SESSION['message'] . '</h3>
                      </div>';
                    $_SESSION['message'] = "";
                }

                ?>

                <h1 class="text-center bg-success text-white p-2 shadow">Liste des logements </h1>
                <table class=table>
                    <thead class="bg-dark text-white border shadow  ">
                        <th>ID</th>
                        <th>Titre </th>
                        <th>Adresse </th>
                        <th>Ville </th>
                        <th>Code postale </th>
                        <th>Surface </th>
                        <th>Prix </th>
                        <th>Photo </th>
                        <th>Type </th>
                        <th>Description </th>

                        <th>Actions </th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results as $produit) {
                        ?>
                            <tr class="">
                                <td><?= $produit['id_logement'] ?> </td>
                                <td><?= $produit['titre'] ?> </td>
                                <td><?= $produit['adresse'] ?> </td>
                                <td><?= $produit['ville'] ?> </td>
                                <td><?= $produit['cp'] ?> </td>
                                <td><?= $produit['surface'] ?>m² </td>
                                <td><?= $produit['prix'] ?> &euro;</td>
                                <td><img src="<?= $produit['photo'] ?>" alt="images" width="100px" height="50px"> </td>
                                <td><?= $produit['types'] ?> </td>
                                <td><?= $produit['descriptions'] ?> </td>

                                <td class="g-2 my-2">

                                    <a href="details.php?id_logement=<?= $produit['id_logement'] ?>" class="border bold border-success bg-info text-dark text-decoration-none p-2 my-4">voir</a>
                                    <a href="edit.php?id_logement=<?= $produit['id_logement'] ?>" class="border bold border-success bg-info text-dark text-decoration-none p-2 my-4">Edit</a>
                                    <a href="delete.php?id_logement=<?= $produit['id_logement'] ?>" class="border bold border-success bg-info text-dark text-decoration-none p-2 my-4">Supp</a>
                                </td>

                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                </table>
                <!--ajout des produits dans la base -->
                <a href="add.php" class="border bold border-success bg-success text-white text-center text-decoration-none p-2 my-2">Ajouter un logement </a>
            </section>
        </div>
    </main>

    <?php require_once "partials/footer.php" ?>
</body>

</html>