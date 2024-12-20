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
</body>
</html>
