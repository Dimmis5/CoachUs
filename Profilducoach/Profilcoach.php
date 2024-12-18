<!DOCTYPE html>
<html>
<head>
    <title>Profil du coach</title>
    <link rel="stylesheet" href="../Profilducoach/profilcoach.css">
</head>
<body>
    <?php
    include('../BDD/connexion.php');
    ?>

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

    <div class="profilc">
        <img src="ImageCoach.jpg" alt="image du coach" width="200" height="200"/>
    </div>

    <div class="info">
        <p>Nom :
        <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?>
        </p>
        <p>Prénom :
        <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
        </p>
        <p>Adresse mail :
        <?php
        $sql = "SELECT adresse_mail FROM coach WHERE id_coach = 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['adresse_mail']);
        } else {
            echo "Non trouvé";
        }
        ?>
        </p>
        <p>Numéro :
        <?php
        $sql = "SELECT numero_de_telephone FROM coach WHERE id_coach = 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['numero_de_telephone']);
        } else {
            echo "Non trouvé";
        }
        ?>
        </p>
    </div>

    <form>
        <div class="encadrer1">
            <p align="center">
                <?php
                $sql = "SELECT date FROM disponibilite ";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo htmlspecialchars($row['date']);
                } else {
                    echo "Date non trouvée.";
                }
                ?>
            </p>

            <div class="horaires-container">
                <?php
                $sql = "SELECT id_disponibilite, heure_debut FROM disponibilite ORDER BY heure_debut";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<button value="' . htmlspecialchars($row['id_disponibilite']) . '">'
                            . htmlspecialchars($row['heure_debut']) . '</button>';
                    }
                } else {
                    echo "<p>Aucune disponibilité trouvée.</p>";
                }
                ?>
            </div>
        </div>
    </form>
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

