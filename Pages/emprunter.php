<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        require_once('connexion.php');
        if (isset($_GET['action']) && $_GET['action'] == 'annuler' && isset($_GET['nolivre'])) {
            $nolivre = $_GET['nolivre'];
            if (isset($_SESSION['panier'][$nolivre])) {
                unset($_SESSION['panier'][$nolivre]);
            }
            header('Location: panier.php');
            exit();
        }
        if (isset($_GET['emprunter'])) {
            $titre = $_GET['titre'];
            $nolivre = $_GET['nolivre'];
            foreach ($_SESSION['panier'] as $item) {
                if ($item == $titre) {
                    header('Location: index.php?error=2');
                    exit();
                }
            }
            if (count($_SESSION['panier']) >= 5) {
                header('Location: index.php?error=3');
                exit();
            }
            $_SESSION['panier'][$nolivre] = $titre;
            header('Location: index.php');
        }
    ?>
</body>