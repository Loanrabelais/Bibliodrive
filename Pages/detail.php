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
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
    <div class="container-fluid">
        <?php require_once('entete.php'); ?>
        <div class="row">
            <div class="col-sm-9">
                <?php
                    require_once('connexion.php');
                    $nolivre = $_GET['nolivre'];
                    $stmt = $connexion->prepare(
                        "SELECT titre, livre.nolivre, nom, prenom, isbn13, detail, photo, dateretour, dateemprunt
                        FROM livre
                        INNER JOIN auteur on livre.noauteur=auteur.noauteur
                        LEFT JOIN emprunter on livre.nolivre=emprunter.nolivre
                        WHERE livre.nolivre = :nolivre
                        ORDER BY dateemprunt DESC LIMIT 1"
                    );
                    $stmt->bindParam(':nolivre', $nolivre);
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    $enregistrement = $stmt->fetch();
                    if ($enregistrement) {
                        echo 'auteur :', $enregistrement->nom, $enregistrement->prenom, '<br>';
                        echo 'ISBN :', $enregistrement->isbn13, '<br>';
                        echo $enregistrement->detail, '<br>';
                        echo '<img class="photo-livre" src="http://localhost/Bibliodrive/covers/', $enregistrement->photo,'">';
                        if ($enregistrement->dateemprunt != null and $enregistrement->dateretour < $enregistrement->dateemprunt) {
                            echo '<br> Emprunté le : ', $enregistrement->dateemprunt;
                        } else {
                            $titre = $enregistrement->titre;
                            $nolivre = $enregistrement->nolivre;
                            echo '<br> Disponible';
                            if (isset($_SESSION['identifiant'])) {
                                echo '<form method="get" action="emprunter.php">
                                        <input type="hidden" name="titre" value="', $titre, '">
                                        <input type="hidden" name="nolivre" value="', $nolivre, '">
                                        <input type="submit" value="Emprunter" name="emprunter">
                                    </form>';
                            }
                            else {
                                echo '<br> Connectez-vous pour emprunter ce livre.';
                            }
                        }
                    }
                ?>
            </div>
            <?php require_once('formulaire.php'); ?>
        </div>
    </div>
</body>
</html>