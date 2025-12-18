<?php session_start();?>
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
                    if (isset($_GET['error']) && $_GET['error'] == 2) {
                        echo '<p class="erreur">Vous avez déjà emprunté ce livre</p>';
                    }
                    if (isset($_GET['error']) && $_GET['error'] == 3) {
                        echo '<p class="erreur">Vous avez déjà 5 livres dans votre panier</p>';
                    }
                    $stmt = $connexion->prepare("SELECT photo FROM livre ORDER BY dateajout DESC LIMIT 3");
                    $stmt->setFetchMode(PDO::FETCH_OBJ);
                    $stmt->execute();
                    $carousel = [];
                    while($enregistrement = $stmt->fetch())
                    {
                        $carousel[] = $enregistrement->photo;
                    }
                ?>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="http://localhost/Bibliodrive/covers/<?php echo $carousel[0]; ?>">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="http://localhost/Bibliodrive/covers/<?php echo $carousel[1]; ?>">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="http://localhost/Bibliodrive/covers/<?php echo $carousel[2]; ?>">
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Précédent</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Suivant</span>
                    </a>
                </div>
            </div>
            <?php require_once('formulaire.php'); ?>
        </div>
    </div>
</body>
</html>