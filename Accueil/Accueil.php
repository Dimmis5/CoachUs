<!DOCTYPE html>
<html>
    <head>
        <title>CoachUs</title>
        <link rel="stylesheet" href="../Accueil/Accueil.css">
        <style>
        </style>
    </head>

    <body>
    <?php
    include('../BDD/connexion.php');
    ?>
    <div class="top-section">

        <div class="header-container">
            <div align="left">
                <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
                <img src="../LOGO/CoachUS.png" class="logo" alt="logo" width="250" height="70" />
            </div>
            <div align="right" class="button-container">
                <button> <a href="..:FAQ/FAQ.php"> ?</a>  </button>
                <button> <a href="../Connexion/connexionsportif.php">JE VEUX UN COACH </a> </button>
                <button> <a href="../Connexion/connexioncoach.php">JE SUIS COACH  </a></button>
            </div>
        </div>
        <h1> Trouvez <br /> votre Coach </h1>
        <div class="search-container">
                <input type="text" placeholder="Votre recherche" />
                <button class="search-button"> Rechercher </button>
        </div>
        <div class="sport-button">
            <div class="sport">
                <img src="../Images/Basket.png" width="20" height="35"/>
                <img src="../Images/Golf.png" width="20" height="35"/>
                <img src="../Images/Badd.png" width="20" height="35" />
                <img src="../Images/Muscu.png" width="20" height="35"/>
                <img src="../Images/cycli.png" width="20" height="35"/>
                <img src="../Images/Baseball.png" width="20" height="35"/>
                <img src="../Images/ping.png" width="20" height="35"/>
                <img src="../Images/foot.png" width="20" height="35"/>
            </div>
            <div class="stext">
                <p>
                    Basket
                </p>
                <p>
                    Golf<span style="visibility: hidden;">Ad</span>  
                </p>
                <p>
                    Bad <span style="visibility: hidden;">A</span> 
                </p>
                <p>
                    Muscu<span style="visibility: hidden;"></span> 
                </p>
                <p >
                    Cyclisme
                </p>
                <p>
                    Baseball
                </p>
                <p>
                    PingPong
                </p>
                <p>
                    FootBall
                </p>
            </div>
        </div>
    </div>
    <br><br><br><br>

    <div class="prénom">
    <p>
            <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
            <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?>
        
            </p>
            <p>
            <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
            <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?> </p>
            <p>             <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
            <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?> </p>
        </p>
    </div>
    <div class="personnage">
        <a href="../Prodilducoach/Profilcoach.php"><img src="../Images/Didier desdeschamps.jpg" width="200" height="300" /></a>
        <a href="../Profilducoach/Profilcoach.php"><img src="../Images/Carlos.jpg" width="200" height="300" /></a>
        <a href="../Profilducoach/Profilcoach.php"><img src="../Images/Natha.jpg" width="200" height="300" /></a>
    </div>

    <div class="avis">
        <p>
            Avis:
        </p>
        <p>
            Avis:
        </p>
        <p>
            Avis:
        </p>
    </div>
    <div class="tarif">
            <p> Tarif : </p>
            <p> Tarif :</p>
            <p> Tarif :</p>
    </div>

    <div class="temps">
            <p> Temps de réponse : </p>
            <p> Temps de réponse : </p>
            <p> Temps de réponse :</p>
    </div>

    </div>
    <br><br><br>
    <div class="prénom">
    <p>
            <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
            <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?>
        
            </p>
            <p>
            <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
            <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?> </p>
            <p>             <?php
        $sql = "SELECT prenom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['prenom']);
        } else {
            echo "Non trouvé";
        }
        ?>
            <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 3";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo htmlspecialchars($row['nom']);
        } else {
            echo "Non trouvé";
        }
        ?> </p>
        </p>
    </div>
    <div class="personnage">
        <a href="../Profilducoach/Profilcoach.php"><img src="../Images/Darvin.jpg" width="200" height="300" /></a>
        <a href="../Profilducoach/Profilcoach.php"><img src="../Images/Bob.jpg" width="200" height="300" /></a>
        <a href="../Profilducoach/Profilcoach.php"><img src="../Images/Laurent.jpg" width="200" height="300" /></a>
    </div>

    <div class="avis">
        <p>
            Avis:
        </p>
        <p>
            Avis:
        </p>
        <p>
            Avis:
        </p>
    </div>
    <div class="tarif">
            <p> Tarif : </p>
            <p> Tarif :</p>
            <p> Tarif :</p>
    </div>

    <div class="temps">
            <p> Temps de réponse : </p>
            <p> Temps de réponse : </p>
            <p> Temps de réponse :</p>
    </div>


    <br><br><br>
    

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