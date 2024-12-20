<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> RENSEIGNER UN CRENEAU </title>
    <link rel="stylesheet" href="../Creneau/creneau.css">
</head>

<?php

include('../BDD/connexion.php');

$sql = "SELECT id_lieu, nom FROM lieu";
$result = $conn->query($sql);

if (!$result) {
    die("Erreur lors de l'exécution de la requête SQL : " . $conn->error);
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

    <div class='container'>
        <div class="encadrer">
            <h1> RENSEIGNER VOS DISPONIBILITES </h1>
            <form method="post" action="../Creneau/requete_renseignercreneau.php">
                <label for="id_coach"> id_coach :</label>
                <input type="text" id="id_coach" name="id_coach" required>
                <p> </p>
                <label for="date"> Date :</label>
                <input type="date" id="date" name="date" required>
                <p> </p>
                <label for="heure_debut"> Heure de début :</label>
                <input type="time" id="heure_debut" name="heure_debut" required>
                <p> </p>
                <label for="heure_fin"> Heure de fin :</label>
                <input type="time" id="heure_fin" name="heure_fin" required>
                <p> </p>
                <label for="lieu"> Selectionnez un lieu : </label>
                <select name="id_lieu" id="id_lieu">
                    <?php
                        $sql = "SELECT id_lieu, nom FROM lieu";
                        $result = $conn->query($sql);
                        if ($result->num_rows>0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id_lieu'] . '">' . htmlspecialchars($row['nom_lieu']) . '</option>';
                            }
                        }
                    ?>
                </select>
                <br>
                <label for="sport"> Selectionnez un sport : </label>
                <select name="id_sport" id="id_sport">
                    <?php
                        $sql = "SELECT id_sport, nom FROM sport";
                        $result = $conn->query($sql);
                        if ($result->num_rows>0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id_sport'] . '">' . htmlspecialchars($row['id_lieu']) . '</option>';
                            }
                        }
                    ?>
                </select>
                <p> </p>
                <button type="submit"> AJOUTER LE CRENEAU </button>
            </form>
        </div>
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


<?php
$conn->close();
?>
