<!DOCTYPE html>
<html>
    <head>
        <title>CoachUs</title>
        <link rel="stylesheet" href="Accueil.css">
        <style>
        </style>
    </head>

    <body>
    <?php
    include('connexion.php');
    ?>
    <div class="top-section">

        <div class="header-container">
            <div align="left">
                <img src="LOGO2.png" alt="logo" width="50" height="75" />
                <img src="CoachUs Text copie.png" class="logo" alt="logo" width="250" height="70" />
            </div>
            <div align="right" class="button-container">
                <button> <a href="FAQ.html"> ?</a>  </button>
                <button> <a href="connexionsportif.html">JE VEUX UN COACH </a> </button>
                <button> <a href="connexioncoach.html">JE SUIS COACH  </a></button>
            </div>
        </div>
        <h1> Trouvez <br /> votre Coach</h1>
        <div class="search-container">
                <input type="text" placeholder="Votre recherche" />
                <button class="search-button"> Rechercher </button>
        </div>
        <div class="sport-button">
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
        <a href="Profil du coach.php"><img src="Moi.jpg" width="150" height="200" /></a>
        <a href="Profil du coach.php"><img src="Moi.jpg" width="150" height="200" /></a>
        <a href="Profil du coach.php"><img src="Moi.jpg" width="150" height="200" /></a>
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
        <a href="Profil du coach.php"><img src="Moi.jpg" width="150" height="200" /></a>
        <a href="Profil du coach.php"><img src="Moi.jpg" width="150" height="200" /></a>
        <a href="Profil du coach.php"><img src="Moi.jpg" width="150" height="200" /></a>
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