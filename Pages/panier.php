<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste livres</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
    <div class="container-fluid">
        <?php require_once('entete.php'); ?>
        <div class="row">
            <div class="col-sm-9">
                <?php
                    require_once('connexion.php');// je veux afficher les titres des livres empruntés
                    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
                        echo '<h3>Livres dans votre panier :</h3><ul>';
                        foreach ($_SESSION['panier'] as $titre) {
                            echo '<li>' . htmlspecialchars($titre) . '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>Votre panier est vide.</p>';
                    }
                ?>
            </div>
            <?php require_once('formulaire.php'); ?>
        </div>
    </div>
</body>
</html>