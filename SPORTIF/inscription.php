<?php
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title> Inscription </title>
    <link rel="stylesheet" href="../SPORTIF/inscription.css">
</head>
<body>
    <div class='container'>
        <div class="encadrer">
        </div>

        <?php
        if (!empty($erreurs)) {
            echo "<ul class='errors'>";
            foreach ($erreurs as $erreur) {
                echo "<li>" . htmlspecialchars($erreur) . "</li>";
            }
            echo "</ul>";
        }
        ?>

        <form method="POST" action="../REQUETES_SPORTIF/inscription.php">
            <div class="encadrer">
                <h1 align="center">INSCRIPTION</h1>
                <div class="search-container">
                    <input type="text" name="nom" placeholder="NOM" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="prenom" placeholder="PRENOM" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="adresse" placeholder="ADRESSE" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="numero_de_telephone" placeholder="NUMERO DE TELEPHONE" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="adresse_mail" placeholder="ADRESSE MAIL" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="identifiant" placeholder="IDENTIFIANT" required/>
                </div>
                <div class="search-container">
                    <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE" required/>
                </div>
                <button type="submit">S'INSCRIRE</button>
            </div>
        </form>
    </div>
</body>
</html>
