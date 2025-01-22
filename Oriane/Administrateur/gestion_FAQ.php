<?php
include('../BDD/connexion.php');

// Vérifier si une question a été envoyée
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = isset($_POST['question']) ? $_POST['question'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    if (!empty($question) && !empty($category)) {
        // Sauvegarder la question dans une table temporaire pour la modération
        $query = "INSERT INTO faq_pending (question, category) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $question, $category);
        $stmt->execute();
        echo "Question envoyée avec succès pour modération.";
    } else {
        echo "Erreur : Tous les champs sont requis.";
    }
}

// Afficher les questions en attente pour modération
$query_pending = "SELECT id, question, category FROM faq_pending";
$result_pending = $conn->query($query_pending);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Questions</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Modération des Questions</h1>
    <?php if ($result_pending->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Catégorie</th>
                <th>Question</th>
                <th>Réponse</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result_pending->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= htmlspecialchars($row['question']) ?></td>
                    <form action="save_question.php" method="post">
                        <td>
                            <textarea name="reponse" rows="4" cols="50" required></textarea>
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="category" value="<?= $row['category'] ?>">
                            <button type="submit">Enregistrer</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Aucune question en attente.</p>
    <?php endif; ?>
</body>
</html>
