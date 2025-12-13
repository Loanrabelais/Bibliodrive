<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        session_start();
        require_once('connexion.php');
        if (isset($_GET['emprunter'])) {
            $titre = $_GET['titre'];
            $_SESSION['panier'][] = $titre;
            header('Location: index.php');
        }
    ?>
</body>