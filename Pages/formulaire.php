<div class="col-sm-3">
    <?php
    if (isset($_SESSION['identifiant'])) {
        if ($_SESSION['profil'] == 'admin') {
            echo '<h2>Access Administrateur</h2><br>';
        }
        echo '<h5>Bienvenue ', htmlspecialchars($_SESSION['identifiant']), '</h5>';
        if ($_SESSION['profil'] == 'admin') {
            echo '<form>';
            echo '<input type="button" name="ajout" value="Ajouter un livre" onclick="window.location.href=\'ajout.php?action=livre\'">';
            echo '</form> <br>';
            echo '<form>';
            echo '<input type="button" name="ajout" value="Ajouter un membre" onclick="window.location.href=\'ajout.php?action=membre\'">';
            echo '</form> <br>';
        }
        echo '<form method="POST" action="session.php">
                <input type="submit" value="Deconnexion" name="deconnexion">
            </form>';
    }
    else
    {
	    echo '<form method="POST" action="session.php">
                Identifiant : <input type="text" name="identifiant"><br><br>
                Mot de passe : <input type="password" name="motdepasse">
                <input type="submit" value="Envoyer" name="connexion">
            </form>';
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<p class="erreur">Identifiant ou mot de passe incorrect</p>';
        }
    }
    ?>
</div>