<?php
session_start();
require 'bdd.php';  // Inclure la connexion à la base de données

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['pseudo'])) {
    header('Location: messagerie.php');  // Rediriger vers la messagerie si l'utilisateur est déjà connecté
    exit;
}

if (isset($_POST['connexion'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    
    // Vérifier si le pseudo existe dans la base de données
    $checkUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $checkUser->execute([$pseudo]);
    
    if ($checkUser->rowCount() > 0) {
        // Si l'utilisateur existe, démarrer la session
        $_SESSION['pseudo'] = $pseudo;
        header('Location: messagerie.php');
        exit;
    } else {
        $error = 'Pseudo invalide';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylem.css">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error)) { echo '<p style="color:red;">' . $error . '</p>'; } ?>
    <form method="POST">
        <input type="text" name="pseudo" placeholder="Entrez votre pseudo" required>
        <button type="submit" name="connexion">Se connecter</button>
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
