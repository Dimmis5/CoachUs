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


    <div class="header-container">
        <div align="left">
        <img src="LOGO2.png" alt="logo" width="50" height="75" />
        <img src="CoachUs Text copie.png" alt="logo" width="250" height="70" />
        </div>
        <div align="right" class="button-container">
            <button> <a href="FAQ.html"> ?</a> </button>
            <button> <a href="connexionsportif.html">JE VEUX UN COACH </a> </button>
            <button> <a href="connexioncoach.html">JE SUIS COACH  </a></button>
        </div>
    </div>

    <div class="profilc">
        <a href="Profil du coach.php"><img src="../Images/Didier desdeschamps.jpg" width="150" height="200" /></a>
    </div>

    <div class="info">
        <p>Nom :
        <?php
        $sql = "SELECT nom FROM coach WHERE id_coach = 4";
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
        $sql = "SELECT prenom FROM coach WHERE id_coach = 4";
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
        $sql = "SELECT adresse_mail FROM coach WHERE id_coach = 4";
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
        $sql = "SELECT numero_de_telephone FROM coach WHERE id_coach = 4";
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
        <div class="encadrer2">
                <h1 align="center">
                    Coach Profesionnel de Football 
                </h1>
            <p>
            Je suis Didier Deschamps, ancien joueur de football et aujourd’hui entraîneur. J’ai eu la chance de remporter la Coupe du Monde 1998 et l’Euro 2000 en tant que capitaine de l’équipe de France. Comme entraîneur, j’ai guidé les Bleus à une nouvelle victoire en Coupe du Monde en 2018. Passionné par le collectif et le dépassement de soi, je m’efforce toujours de tirer le meilleur de chaque équipe.
            </p>
        </div>
    </form>
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
</body>
</html>
