<!DOCTYPE html>
<html>  
    <head>
        <title> Connexion du coach </title>
        <link rel="stylesheet" href="connexion.css">
    </head>

    <?php
    if (!empty($erreurs)) {
        echo "<ul>";
        foreach ($erreurs as $erreur) {
            echo "<li>" . $erreur . "</li>";
        }
        echo "</ul>";
    }
?>
    <body>
        <div class="logo"></div>
        <div class="header-container">
            <img class="logo" src="CoachUs Text.png" alt="logo" width="250" height="75" />
            <div align="right" class="button-container">
                <button> <a href="FAQ.html"> ?</a>  </button>
                <button> <a href="connexionsportif.html"> JE VEUX UN COACH </a> </button>
                <button> <a href="connexioncoach.html"> JE SUIS COACH  </a></button>
                <button> <a href="Accueil.html"> ACCUEIL </a></button>
            </div>
        </div>
        <p> </p>
        <div class='container'>
            <div class="encadrer">
                <h1> PARTAGEZ VOTRE EXPERTISE, VIVEZ DE VOTRE PASSION ! </h1>
                <p> Créez votre propre emploi du temps et enseignez à votre rythme </p>
                <p> Coachez en ligne ou en personne, où que vous soyez </p>
                <p> Fixez vos tarifs librement - valorisez votre savoir-faire (entre 20 et 80€ de l'heure) </p>
                <p> </p>
                <p> Vous êtes étudiant, professionnel, passionné ou diplômé ? Inscrivez-vous dès maintenant et commencez à coacher sur notre plateforme ! </p>
                <p> </p>
            </div>
            <form method="POST" action="requete_connexioncoach.php">
                <div class="encadrer">
                    <h1 align="center"> CONNEXION </h1>
                    <div class="search-container">
                        <input type="text" name="identifiant" placeholder="IDENTIFIANT"/>
                    </div>
                    <div class="search-container">
                        <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                    </div><br>
                    <button> CONNEXION </button>
                    <div class="rectangle">
                        <div class="cercle"> 
                            <span> OU </span>
                        </div>
                    </div>
                    <button><a href="inscriptioncoach.php">INSCRIPTION  </a> </button>
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
                  <li><a href="#"> Mentions Légales </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>Nos Lieux</h3>
                <ul>
                    <li><a href="Carte.html"> Aubervilliers </a></li>
                    <li><a href="Carte.html"> Boulogne-Billancourt </a></li>
                    <li><a href="Carte.html"> Châtillon </a></li>
                    <li><a href="Carte.html"> Colombes </a></li>
                    <li><a href="Carte.html"> Courbevoie </a></li>
                    <li><a href="Carte.html"> Créteil </a></li>
                    <li><a href="Carte.html"> Issy-les-Moulineaux </a></li>
                    <li><a href="Carte.html"> Massy </a></li>
                    <li><a href="Carte.html"> Meudon </a></li>
                    <li><a href="Carte.html"> Paris </a></li>
                    <li><a href="Carte.html"> Versailles </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>Nous Contacter</h3>
                <ul>
                  <li> support@coachus.com </li>
                  <li><a href="FAQ.html"> FAQ </a></li>
                </ul>
              </div>
            </div>
          
            <div class="footer-bottom">
              <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
            </div>
        </footer>
    </body>
</html>