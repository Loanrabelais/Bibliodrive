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
                    if (isset($_SESSION['identifiant']) and ($_SESSION['profil'] == 'admin')){
                        require_once('connexion.php');
                        if ($_GET['action'] == 'livre')
                        {
                            echo '<h2>Ajouter un livre</h2>';
                            echo '<form method="post" action="">';
                            $stmt = $connexion->prepare(
                            "SELECT noauteur, nom
                            FROM auteur"
                            );
                            $stmt->setFetchMode(PDO::FETCH_OBJ);
                            $stmt->execute();
                            echo '<select name="noauteur">';
                            while ($enregistrement = $stmt->fetch()) {
                                $noa = (int)$enregistrement->noauteur;
                                $nom = htmlspecialchars($enregistrement->nom, ENT_QUOTES);
                                echo '<option value="'. $noa .'">'. $nom .'</option>';
                            }
                            echo '</select><br>';
                            echo 'Titre : <input type="text" name="titre" size="20"/><br>';
                            echo 'ISBN13 : <input type="text" name="isbn" size="20"/><br>';
                            echo 'Année de parution : <input type="text" name="annee_parution" size="20"/><br>';
                            echo 'Resumé : <input type="text" name="resume" size="20"/><br>';
                            echo 'Image : <input type="text" name="image" size="20"/><br>';
                            echo '<input type="submit" name="valider_livre" value="Valider"/>';
                            echo '</form>';
                            if (isset($_POST['valider_livre'])){
                                $noauteur = isset($_POST['noauteur']) ? intval($_POST['noauteur']) : null;
                                $titre = ($_POST['titre'] ?? '');
                                $isbn = ($_POST['isbn'] ?? '');
                                $annee = ($_POST['annee_parution'] ?? '');
                                $resume = ($_POST['resume'] ?? '');
                                $image = ($_POST['image'] ?? '');
                                if ($_POST['titre'] !== '' &&
                                    $_POST['isbn'] !== '' &&
                                    $_POST['annee_parution'] !== '' &&
                                    $_POST['image'] !== '' &&
                                    $_POST['resume'] !== '') {
                                    $stmt = $connexion->prepare(
                                        "INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, dateajout, photo)
                                        VALUES (:noauteur, :titre, :isbn, :annee, :detail, NOW(), :photo)"
                                    );
                                    $stmt->bindParam(':noauteur', $noauteur);
                                    $stmt->bindParam(':titre', $titre);
                                    $stmt->bindParam(':isbn', $isbn);
                                    $stmt->bindParam(':annee', $annee);
                                    $stmt->bindParam(':detail', $resume);
                                    $stmt->bindParam(':photo', $image);
                                    $stmt->execute();
                                    echo 'Livre ajouté';
                                    exit;
                                } else {
                                    echo '<p class="erreur">Veuillez remplir tous les champs.</p>';
                                }
                            }
                        }
                        elseif ($_GET['action'] == 'membre')
                        {
                            echo '<h2>Ajouter un membre</h2>';
                            echo '<form method="post" action="">';
                            echo 'Mel : <input type="text" name="mel" size="20"/><br>';
                            echo 'MDP : <input type="text" name="mdp" size="20"/><br>';
                            echo 'nom : <input type="text" name="nom" size="20"/><br>';
                            echo 'prénom : <input type="text" name="prenom" size="20"/><br>';
                            echo 'addresse : <input type="text" name="addresse" size="20"/><br>';
                            echo 'Ville : <input type="text" name="ville" size="20"/><br>';
                            echo 'Code postale : <input type="text" name="postal" size="20"/><br>';
                            echo '<input type="submit" name="valider_membre" value="Valider"/>';
                            echo '</form>';
                            if (isset($_POST['valider_membre'])){
                                $mel = ($_POST['mel'] ?? '');
                                $mdp = ($_POST['mdp'] ?? '');
                                $nom = ($_POST['nom'] ?? '');
                                $prenom = ($_POST['prenom'] ?? '');
                                $addresse = ($_POST['addresse'] ?? '');
                                $ville = ($_POST['ville'] ?? '');
                                $postal = ($_POST['postal'] ?? '');
                                if ($_POST['mel'] !== '' &&
                                    $_POST['mdp'] !== '' &&
                                    $_POST['nom'] !== '' &&
                                    $_POST['prenom'] !== '' &&
                                    $_POST['addresse'] !== '' &&
                                    $_POST['ville'] !== ''&&
                                    $_POST['postal'] !== '') {
                                    $hash = password_hash($mdp, PASSWORD_ARGON2ID);
                                    $stmt = $connexion->prepare(
                                        "INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil)
                                        VALUES (:mel, :hash, :nom, :prenom, :addresse, :ville, :postal, :profil)"
                                    );
                                    $stmt->bindParam(':mel', $mel);
                                    $stmt->bindParam(':hash', $hash);
                                    $stmt->bindParam(':nom', $nom);
                                    $stmt->bindParam(':prenom', $prenom);
                                    $stmt->bindParam(':addresse', $addresse);
                                    $stmt->bindParam(':ville', $ville);
                                    $stmt->bindParam(':postal', $postal);
                                    $profil = 'client';
                                    $stmt->bindParam(':profil', $profil);
                                    $stmt->execute();
                                    echo 'membre ajouté';
                                } else {
                                    echo '<p class="erreur">Veuillez remplir tous les champs.</p>';
                                }
                            }
                        }
                        else {
                            echo '<p class="erreur">Action selectionnée incorrecte</p>';
                        }
                    }
                    else{
                        echo '<p class="erreur">Accès interdit</p>';
                    }
                ?>
            </div>
            <?php require_once('formulaire.php'); ?>
        </div>
    </div>
</body>
</html>