<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <?php require_once('entete.php'); ?>
        <div class="row">
            <div class="col-sm-9">
                <?php
                    require_once('connexion.php');
                    $nolivre = $_GET['nolivre'];
                    $stmt = $connexion->prepare("SELECT nom, prenom, isbn13, detail, photo FROM livre INNER JOIN auteur on livre.noauteur=auteur.noauteur WHERE :nolivre = nolivre");
                    $stmt->bindParam(':nolivre', $nolivre);
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    $enregistrement = $stmt->fetch();
                    if ($enregistrement) {
                        echo 'auteur :', $enregistrement->nom, $enregistrement->prenom, '<br>';
                        echo 'ISBN :', $enregistrement->isbn13, '<br>';
                        echo $enregistrement->detail, '<br>';
                        echo '<img src="http://localhost/Bibliodrive/covers/', $enregistrement->photo,'">';
                    }
                ?>
            </div>
            <?php require_once('formulaire.php'); ?>
        </div>
    </div>
</body>
</html>