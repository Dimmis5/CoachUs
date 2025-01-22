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
                <a href="../Page des sports/pagesports.php?sport=Basket"><img src="../Images/Basket.png" width="20" height="35" alt="Basket" /></a>
                <a href="../Page des sports/pagesports.php?sport=Golf"><img src="../Images/Golf.png" width="20" height="35" alt="Golf" /></a>
                <a href="../Page des sports/pagesports.php?sport=Badminton"><img src="../Images/Badd.png" width="20" height="35" alt="Badminton" /></a>
                <a href="../Page des sports/pagesports.php?sport=Musculation"><img src="../Images/Muscu.png" width="20" height="35" alt="Musculation" /></a>
                <a href="../Page des sports/pagesports.php?sport=Cyclisme"><img src="../Images/cycli.png" width="20" height="35" alt="Cyclisme" /></a>
                <a href="../Page des sports/pagesports.php?sport=Baseball"><img src="../Images/Baseball.png" width="20" height="35" alt="Baseball" /></a>
                <a href="../Page des sports/pagesports.php?sport=PingPong"><img src="../Images/ping.png" width="20" height="35" alt="Ping Pong" /></a>
                <a href="../Page des sports/pagesports.php?sport=Football"><img src="../Images/foot.png" width="20" height="35" alt="Football" /></a>
            </div>
            <div class="stext">
                <p>Basket</p>
                <p>Golf</p>
                <p>Badminton</p>
                <p>Musculation</p>
                <p>Cyclisme</p>
                <p>Baseball</p>
                <p>Ping Pong</p>
                <p>Football</p>
            </div>
        </div>
    </div>
    <br><br>

    <h2 align="center">Avis de nos utilisateurs</h2>
<div class="enca">
<?php
// Connexion à la base de données
include('../BDD/connexion.php');

// Requête SQL pour récupérer les prénoms des sportifs, noms des coachs, notes et commentaires
$query = "
    SELECT 
        sportif.prenom AS sportif_prenom,
        coach.prenom AS coach_prenom, 
        coach.nom AS coach_nom, 
        reservation.note, 
        reservation.commentaire
    FROM 
        reservation
    INNER JOIN sportif ON reservation.id_sportif = sportif.id_sportif
    INNER JOIN coach ON reservation.id_coach = coach.id_coach
    WHERE 
        reservation.commentaire IS NOT NULL
    ORDER BY 
        reservation.id_reservation DESC
    LIMIT 10
";
$result = $conn->query($query);

// Vérifier si des données sont disponibles
if ($result->num_rows > 0) {
    echo '<div class="user-reviews">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="review">';
        echo '<p><strong>Coach :</strong> ' . htmlspecialchars($row['coach_prenom']) . " " . htmlspecialchars($row['coach_nom']) . '</p>';
        echo '<p><strong>Note :</strong> ' . htmlspecialchars($row['note']) . '/5</p>';
        echo '<p>' . htmlspecialchars($row['commentaire']) . '</p>';
        echo '<p><strong>Sportif :</strong> ' . htmlspecialchars($row['sportif_prenom']) . '</p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo '<p>Aucun avis pour le moment.</p>';
}
?>
</div>


</div>

</div>


    <h2 align="center">Apprendre n'a jamais été aussi simple</h2>
    <div class="flex">
    <div class="encadrer">
        
        <h2>1. Rechercher</h2>
        <p> Consultez librement les profils  des coachs selon vos critères</p>
    </div>
   <div class="encadrer2">
        <h2> 2. Contactez </h2>
        <p>Les coachs vous répondent en seulement quelque heure !  Et si vous ne trovuez pas tout de suite le coach idéal, notre équipe sera là pour vous aider</p>
   </div> 
   <div class="encadrer3">
        <h2>3. Organisez</h2>
        <p>Echangez et programmez vos séance simplement depuis la messagerie avec votre coach</p>
   </div>
   </div>

 
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Nos Services</h3>
                <ul>
                    <li><a href="#">Service clientèle</a></li>
                    <li><a href="#">Règlement intérieur</a></li>
                    <li><a href="#">Heure d'ouverture</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>À propos</h3>
                <ul>
                    <li><a href="#">Notre Histoire</a></li>
                    <li><a href="../Mentionslégales/MentionsLégales.html">Mentions Légales</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Nos Lieux</h3>
                <ul>
                    <li><a href="../Carte/Carte.html">Aubervilliers</a></li>
                    <li><a href="../Carte/Carte.html">Boulogne-Billancourt</a></li>
                    <li><a href="../Carte/Carte.html">Châtillon</a></li>
                    <li><a href="../Carte/Carte.html">Colombes</a></li>
                    <li><a href="../Carte/Carte.html">Courbevoie</a></li>
                    <li><a href="../Carte/Carte.html">Créteil</a></li>
                    <li><a href="../Carte/Carte.html">Issy-les-Moulineaux</a></li>
                    <li><a href="../Carte/Carte.html">Massy</a></li>
                    <li><a href="../Carte/Carte.html">Meudon</a></li>
                    <li><a href="../Carte/Carte.html">Paris</a></li>
                    <li><a href="../Carte/Carte.html">Versailles</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Nous Contacter</h3>
                <ul>
                    <li>support@coachus.com</li>
                    <li><a href="../FAQ/FAQ.html">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
        </div>
    </footer>
    </body>
</html>
