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
</head>
<body>
    <div class="container-fluid">
    <?php
        require_once('entete.php');
        require_once('connexion.php');
        $recherche = $_GET['recherche'];
        $stmt = $connexion->prepare("SELECT titre, anneeparution, nolivre FROM livre INNER JOIN auteur on livre.noauteur=auteur.noauteur WHERE auteur.nom = :nom");
        $stmt->bindParam(':nom', $recherche);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        while($enregistrement = $stmt->fetch())
        {
                echo '<a href="detail.php?nolivre=' . $enregistrement->nolivre . '">' . $enregistrement->titre . ' (' . $enregistrement->anneeparution . ')</a><br>';
        }
    ?>
    </div>
    <?php require_once('formulaire.php'); ?>
    </div>
</body>
</html>