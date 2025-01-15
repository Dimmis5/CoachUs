<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Créneaux</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #B8C5D6, #FFDFA7);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 800px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .day-section {
            background-color: #FFF7E5;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.8em;
        }

        .slot-form {
            display: inline-block;
            margin: 5px;
        }

        .slot {
            background-color: #FFEDC1;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .slot:hover {
            background-color: #FFD480;
            transform: scale(1.05);
        }

        footer {
    background-color: #333;
    color: #fff;
    padding: 30px 0;
    font-family: 'Arial', sans-serif;
}
 
.footer-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
 
 
.footer-column h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #f39c12;
    border-bottom: 2px solid #f39c12;
    padding-bottom: 5px;
}
 
.footer-column ul {
    list-style: none;
    padding: 0;
}
 
.footer-column:nth-child(3) ul {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
 
.footer-column a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
    display: block;
    margin-bottom: 10px;
    transition: color 0.3s;
}
 
.footer-column a:hover {
    color: #f39c12;
}
 
.footer-bottom {
    text-align: center;
    margin-top: 40px;
    font-size: 14px;
}
 
.footer-links {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}
 
.footer-links a {
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    transition: color 0.3s;
}
 
.footer-links a:hover {
    color: #f39c12;
}
 
@media (max-width: 768px) {
    .footer-container {
        grid-template-columns: 1fr;
        text-align: center;
    }
 
    .footer-column {
        margin-bottom: 20px;
    }
 
    .footer-column ul {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Réservation de Créneaux</h1>

        <!-- Mardi 1 Octobre -->
        <div class="day-section">
            <h2>Mardi 1 Octobre</h2>
            <?php
                $creneaux = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
                foreach ($creneaux as $heure) {
                    echo '
                        <form action="reservation.php" method="POST" class="slot-form">
                            <input type="hidden" name="creneau" value="Mardi 1 Octobre - ' . $heure . '">
                            <button type="submit" class="slot">' . $heure . '</button>
                        </form>';
                }
            ?>
        </div>

        <!-- Mercredi 2 Octobre -->
        <div class="day-section">
            <h2>Mercredi 2 Octobre</h2>
            <?php
                $creneaux = ['07:30', '10:00', '14:00', '15:00', '16:00', '18:00'];
                foreach ($creneaux as $heure) {
                    echo '
                        <form action="reservation.php" method="POST" class="slot-form">
                            <input type="hidden" name="creneau" value="Mercredi 2 Octobre - ' . $heure . '">
                            <button type="submit" class="slot">' . $heure . '</button>
                        </form>';
                }
            ?>
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