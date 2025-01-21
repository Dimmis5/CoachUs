<!DOCTYPE html>
<html lang="fr">
<?php
include('../BDD/connexion.php');


$type = $_GET['type'] ?? '';

if ($type !== 'sportif' && $type !== 'coach') {
    die('Type invalide. Assurez-vous que l\'URL contient un paramètre "type" valide.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    if (empty($id)) {
        die('ID du ' . $type . ' invalide.');
    }

    try {
        $query = "DELETE FROM $type WHERE id_" . $type . " = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo ucfirst($type) . " supprimé avec succès.";
    } catch (mysqliException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
}

try {
    $query = "SELECT id_" . $type . ", nom, prenom FROM $type";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (mysqliException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>

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
            <h1 align="center">Tous les <?php echo ucfirst($type); ?>s</h1>
            <?php
               
                if (count($utilisateurs) > 0) {
                    foreach ($utilisateurs as $utilisateur) {
                        echo "Nom : " . htmlspecialchars($utilisateur['nom']) . "<br>";
                        echo "Prénom : " . htmlspecialchars($utilisateur['prenom']) . "<br><br>";
                    }
                } else {
                    echo "Aucun " . $type . " trouvé.";
                }
            ?>

            <h1 align="center">Supprimer un <?php echo ucfirst($type); ?></h1>
            <form method="POST">
                <label for="id">Sélectionnez un <?php echo $type; ?> :</label>
                <select name="id" id="id" required>
                    <?php foreach ($utilisateurs as $utilisateur): ?>
                        <option value="<?php echo $utilisateur["id_$type"]; ?>">
                            <?php echo htmlspecialchars($utilisateur['nom'] . ' ' . $utilisateur['prenom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Supprimer</button>
            </form>
        </div>
    </div>
</body>
</html>
