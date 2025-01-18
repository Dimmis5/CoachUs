<?php
include('../BDD/connexion.php');

$type = $_GET['type'] ?? '';
if ($type !== 'sportif' && $type !== 'coach') {
    die('Type invalide.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    try {
        $query = "DELETE FROM $type WHERE id_" . $type . " = :id";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo ucfirst($type) . " supprimé avec succès.";
    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
}

try {
    $query = "SELECT id_" . $type . ", nom, prenom FROM $type";
    $stmt = $connexion->prepare($query);
    $stmt->execute();
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un utilisateur</title>
</head>
<body>
    <h1>Supprimer un <?php echo htmlspecialchars($type); ?></h1>
    <form method="POST">
        <label for="id">Sélectionnez un <?php echo htmlspecialchars($type); ?> :</label>
        <select name="id" id="id" required>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <option value="<?php echo $utilisateur["id_$type"]; ?>">
                    <?php echo $utilisateur['nom'] . ' ' . $utilisateur['prenom']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Supprimer</button>
    </form>
</body>
</html>
