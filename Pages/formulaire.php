<div class="col-sm-3">
    <?php
    if (isset($_SESSION['identifiant'])) {
        echo '<h5>Bienvenue ', htmlspecialchars($_SESSION['identifiant']), '</h5>';
        echo '<form method="POST" action="session.php">
                <input type="submit" value="Deconnexion" name="deconnexion">
            </form>';
    }
    else
    {
	    echo '<form method="POST" action="session.php">
                Identifiant : <input type="text" name="identifiant"><br><br>
                Mot de passe : <input type="text" name="motdepasse">
                <input type="submit" value="Envoyer" name="connexion">
            </form>';
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="erreur">Identifiant ou mot de passe incorrect</p>';
        }
    }
    ?>
</div>