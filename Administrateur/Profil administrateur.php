<?php
include('../BDD/connexion.php'); // Connexion à la base de données

try {
   
    $query_sportifs = "SELECT COUNT(*) AS total_sportifs FROM sportif";
    $stmt_sportifs = $conn->prepare($query_sportifs);
    $stmt_sportifs->execute();
    $total_sportifs = $stmt_sportifs->fetch(PDO::FETCH_ASSOC)['total_sportifs'];

    
    $query_coachs = "SELECT COUNT(*) AS total_coachs FROM coach";
    $stmt_coachs = $conn->prepare($query_coachs);
    $stmt_coachs->execute();
    $total_coachs = $stmt_coachs->fetch(PDO::FETCH_ASSOC)['total_coachs'];


    $total_inscrits = $total_sportifs + $total_coachs;
} catch (PDOException $e) {
    die("Erreur lors de l'exécution des requêtes : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Administrateur</title>
    <link rel="stylesheet" href="../Profilducoach/az.css">
</head>
<body>
    <div class="container">
        <div class="menu-gauche">
            <h2>Administrateur</h2>
        </div>

        <div class="contenu-principal">
            <h1 align="center">Bienvenue dans l'espace Administrateur</h1>
            <h2>Statistiques Globales :</h2>
            <ul>
                <li>Nombre total d'inscrits : <strong><?php echo $total_inscrits; ?></strong></li>
                <li>Nombre total de sportifs inscrits : <strong><?php echo $total_sportifs; ?></strong></li>
                <li>Nombre total de coachs inscrits : <strong><?php echo $total_coachs; ?></strong></li>
            </ul>
            
            <h2>Gestion des utilisateurs</h2>
            <ul>
                <li><a href="../Administrateur/gere_sportif.php">Gérer les sportifs</a></li>
                <li><a href="../Administrateur/gere_sportif.php">Gérer les coachs</a></li>
                <li><a href="../Administrateur/ajouter_utilisateur.php?type=sportif">Ajouter un sportif</a></li>
                <li><a href="../Administrateur/ajouter_utilisateur.php?type=coach">Ajouter un coach</a></li>
                <li><a href="../Administrateur/Supprimer_utilisateur.php?type=sportif">Supprimer un sportif</a></li>
                <li><a href="../Administrateur/Supprimer_utilisateur.php?type=coach">Supprimer un coach</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
