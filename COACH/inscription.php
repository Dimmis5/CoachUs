<?php
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion du coach</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>
<?php include('../PRESENTATION/haut_de_page.php');?>
    <div class='container'>
        <div class="encadrer">
            <h1>PARTAGEZ VOTRE EXPERTISE, VIVEZ DE VOTRE PASSION !</h1>
            <p>Créez votre propre emploi du temps et enseignez à votre rythme</p>
            <p>Coachez en ligne ou en personne, où que vous soyez</p>
            <p>Fixez vos tarifs librement - valorisez votre savoir-faire (entre 20 et 80€ de l'heure)</p>
            <p>Vous êtes étudiant, professionnel, passionné ou diplômé ? Inscrivez-vous dès maintenant et commencez à coacher sur notre plateforme !</p>
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

        <form method="POST" action="../REQUETES_COACH/inscription.php">
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
    <?php include('../PRESENTATION/bas_de_page.php');?>
</body>
</html>
