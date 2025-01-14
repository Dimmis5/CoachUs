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

    <footer>
            <div class="footer-container">
              <div class="footer-column">
                <h3>Nos Services</h3>
                <ul>
                  <li><a href="#"> Service clientèle </a></li>
                  <li><a href="#"> Réglement intérieur </a></li>
                  <li><a href="#"> Heure d'ouverture </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>À propos</h3>
                <ul>
                  <li><a href="#"> Notre Histoire </a></li>
                  <li><a href="../Mentionslégales/MentionsLégales.html"> Mentions Légales </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>Nos Lieux</h3>
                <ul>
                    <li><a href="../Carte/Carte.html"> Aubervilliers </a></li>
                    <li><a href="../Carte/Carte.html"> Boulogne-Billancourt </a></li>
                    <li><a href="../Carte/Carte.html"> Châtillon </a></li>
                    <li><a href="../Carte/Carte.html"> Colombes </a></li>
                    <li><a href="../Carte/Carte.html"> Courbevoie </a></li>
                    <li><a href="../Carte/Carte.html"> Créteil </a></li>
                    <li><a href="../Carte/Carte.html"> Issy-les-Moulineaux </a></li>
                    <li><a href="../Carte/Carte.html"> Massy </a></li>
                    <li><a href="../Carte/Carte.html"> Meudon </a></li>
                    <li><a href="../Carte/Carte.html"> Paris </a></li>
                    <li><a href="../Carte/Carte.html"> Versailles </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>Nous Contacter</h3>
                <ul>
                  <li> support@coachus.com </li>
                  <li><a href="../FAQ/FAQ.html"> FAQ </a></li>
                </ul>
              </div>
            </div>
          
            <div class="footer-bottom">
              <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
            </div>
        </footer>
</body>
</html>
