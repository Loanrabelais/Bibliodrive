<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
        require_once('connexion.php');
        foreach ($_SESSION['panier'] as $nolivre => $titre) {
            $mel = $_SESSION['identifiant'];
            print("$mel, $nolivre, $titre<br>");
            $stmt = $connexion->prepare(
                "INSERT INTO emprunter (mel, nolivre, dateemprunt)
                VALUES (:mel, :nolivre, NOW())"
            );
            $stmt->bindParam(':mel', $mel);
            $stmt->bindParam(':nolivre', $nolivre);
            $stmt->execute();
            unset($_SESSION['panier'][$nolivre]);
        }
        header('Location: panier.php');
    ?>
</body>
</html>