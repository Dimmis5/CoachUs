<?php
require 'bdd.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'sportif') {
    header('Location: connexion.php');
    exit;
}

if (isset($_POST['specialite']) && !empty($_POST['specialite'])) {
    $specialite = htmlspecialchars($_POST['specialite']);
    $recupCoachs = $bdd->prepare('SELECT * FROM users WHERE role = "coach" AND specialite = ?');
    $recupCoachs->execute([$specialite]);
} else {
    $recupCoachs = $bdd->query('SELECT * FROM users WHERE role = "coach"');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Coach</title>
    <link rel="stylesheet" href="stylem.css">
</head>
<body>
    <div class="form-container">
        <h1>Recherche de Coach</h1>
        <form method="post">
            <select name="specialite" required>
                <option value="">Choisir une spécialité</option>
                <option value="tennis">Tennis</option>
                <option value="football">Football</option>
                <option value="natation">Natation</option>
            </select>
            <button type="submit">Rechercher</button>
        </form>

        <h2>Liste des Coachs</h2>
        <ul>
            <?php while ($coach = $recupCoachs->fetch()) { ?>
                <li>
                    <strong><?php echo htmlspecialchars($coach['pseudo']); ?></strong> - <?php echo htmlspecialchars($coach['specialite']); ?>
                    <a href="messagerie.php?receiver_id=<?php echo $coach['id']; ?>">Envoyer un message</a>
                </li>
            <?php } ?>
        </ul>

        <a href="deconnexion.php" class="btn-deconnexion">Déconnexion</a>
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
