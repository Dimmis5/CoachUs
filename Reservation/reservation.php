<?php
// Activer les erreurs pour débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier les données POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['creneau'])) {
    $creneau = htmlspecialchars($_POST['creneau']);
} else {
    $creneau = "Aucun créneau sélectionné.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
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
            text-align: center;
        }

        .container {
            background-color: #FFF;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 90%;
        }

        h1 {
            font-size: 2.5em;
            color: #F4A940; /* Couleur exacte comme dans votre image */
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5em;
            color: #555;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-size: 1.2em;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
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
        <h1>Félicitations !</h1>
        <p>Votre créneau <strong><?php echo $creneau; ?></strong> a été réservé avec succès.</p>
        <a href="reservation_creneaux.php">Retour à la page de réservation</a>
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