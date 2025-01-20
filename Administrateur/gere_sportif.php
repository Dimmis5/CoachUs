<?php
include('../BDD/connexion.php'); 

try {
  
    $query_sportifs = "SELECT * FROM sportif";
    $stmt_sportifs = $connexion->prepare($query_sportifs);
    $stmt_sportifs->execute();
    $sportifs = $stmt_sportifs->fetchAll(PDO::FETCH_ASSOC);

  
    if (isset($_GET['supprimer_id'])) {
        $id_sportif = $_GET['supprimer_id'];
        $delete_query = "DELETE FROM sportif WHERE id_sportif = :id_sportif";
        $stmt_delete = $connexion->prepare($delete_query);
        $stmt_delete->bindParam(':id_sportif', $id_sportif);
        $stmt_delete->execute();
        header("Location: gerer_sportif.php"); 
        exit;
    }
} catch (PDOException $e) {
    die("Erreur lors de l'exécution des requêtes : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Sportifs</title>
</head>
<body>
    <h1>Liste des Sportifs Inscrits</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sportifs as $sportif): ?>
                <tr>
                    <td><?php echo htmlspecialchars($sportif['id_sportif']); ?></td>
                    <td><?php echo htmlspecialchars($sportif['nom']); ?></td>
                    <td><?php echo htmlspecialchars($sportif['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($sportif['adresse_mail']); ?></td>
                    <td>
                        <a href="gerer_sportif.php?supprimer_id=<?php echo $sportif['id_sportif']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sportif ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
