<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        require_once('connexion.php');
        if (isset($_POST['connexion'])) {
            $mel = $_POST['identifiant'];
            $motdepasse = $_POST['motdepasse'];
            $stmt = $connexion->prepare(
                "SELECT mel, motdepasse, adresse, profil
                FROM utilisateur
                WHERE mel = :mel"
            );
            $stmt->bindParam(':mel', $mel);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $enregistrement = $stmt->fetch();
            if ($enregistrement && password_verify($motdepasse, $enregistrement->motdepasse)) {
                $_SESSION['identifiant'] = $mel;
                $_SESSION['adresse'] = $enregistrement->adresse;
                $_SESSION['profil'] = $enregistrement->profil;
                $_SESSION['panier'] = [];
                header('Location: index.php');
            } else {
                header('Location: index.php?error=1');
            }
        }
        elseif (isset($_POST['deconnexion']))
        {
            $_SESSION['identifiant'] = null;
            session_unset();
            session_destroy();
            header('Location: index.php');
        }
    ?>
</body>
