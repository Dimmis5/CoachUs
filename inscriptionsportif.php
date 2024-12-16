<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> INSCRIPTION </title>
    <link rel="stylesheet" href="inscription.css">

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
    <div class='containerinscription'>
        <div class="encadrer">
        <h1> Ajouter du texte </h1>


        </div>
        <form method="POST" action="requete_inscriptionsportif.php">
            <div class="encadrer">
                <h1 align="center"> INSCRIPTION </h1>

                <div class="search-container">
                    <input type="text" name="nom" placeholder="NOM" required/>
                </div>
            
                <div class="search-container">
                    <input type="text" name="prenom" placeholder="PRENOM"/>
                </div>
                    
                <div class="search-container">
                    <input type="text" name="adresse" placeholder="ADRESSE"/>
                </div>
                
                <div class="search-container">
                    <input type="text" name="numero_de_telephone" placeholder="NUMERO DE TELEPHONE"/>
                </div>
        
                <div class="search-container">
                    <input type="text" name="adresse_mail" placeholder="ADRESSE MAIL"/>
                </div>
                
                <div class="search-container">
                    <input type="text" name="identifiant" placeholder="IDENTIFIANT"/>
                </div>

                <div class="search-container">
                    <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                </div>

                <button type="submit"> S'INSCRIRE </button>
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