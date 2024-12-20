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
</body>
</html>
