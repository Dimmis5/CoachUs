<!DOCTYPE html>
<html>  
    <head>
        <title> Connexion du sportif </title>
        <link rel="stylesheet" href="../Connexion/connexion.css">
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
        <div align="left">
            <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
            <a href="../Accueil/Accueil.html">
                <img class="logo" src="../LOGO/CoachUs.png" alt="logo" width="250" height="75" />
            </a>
        </div>
        <div align="right" class="button-container">
            <button> <a href="../FAQ/FAQ.html"> ?</a>  </button>
            <button> <a href="../Connexion/connexionsportif.php"> JE VEUX UN COACH </a> </button>
            <button> <a href="../Connexion/connexioncoach.php"> JE SUIS COACH  </a></button>
        </div>
    </div>
        <p> </p>
        <div class='container'>
            <div class="encadrer">
               <h1> Ajouter du texte </h1>
                
            </div>
            <form method="POST" action="../Connexion/requete_connexionsportif.php">
                <div class="encadrer">
                    <h1 align="center"> CONNEXION </h1>
                    <div class="search-container">
                        <input type="text" name="identifiant" placeholder="IDENTIFIANT"/>
                    </div>
                    <div class="search-container">
                        <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                    </div><br>
                    <button><a> CONNEXION </a></button>
                    <div class="rectangle">
                        <div class="cercle"> 
                            <span> OU </span>
                        </div>
                    </div>
                    <button><a href="inscriptionsportif.php">INSCRIPTION  </a> </button>
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
