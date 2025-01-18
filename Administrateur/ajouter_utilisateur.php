<?php
include('../BDD/connexion.php');

$type = $_GET['type'] ?? '';
if ($type !== 'sportif' && $type !== 'coach') {
    die('Type invalide.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';

    try {
        $query = "INSERT INTO $type (nom, prenom, adresse_mail) VALUES (:nom, :prenom, :email)";
        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        echo ucfirst($type) . " ajouté avec succès.";
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h1>Ajouter un <?php echo htmlspecialchars($type); ?></h1>
    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
