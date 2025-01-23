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
<?php include('../PRESENTATION/haut_de_page.php');?>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="../Administrateur/administrateur.php"> TABLEAU DE BORD</a></li>
                <li><a href="../Administrateur/coach.php"> COACH </a></li>
                <li><a href="../Administrateur/sportif.php"> SPORTIF </a></li>
                <li><a href="../Administrateur/lieu.php"> LIEU </a></li>
                <li><a href="../Administrateur/gestion_FAQ.php"> FAQ </a></li>
                <li><a href="../Administrateur/inscription_coach/coach_attente.php"> INSCRIPTION COACH </a></li>
                <li><a href="../Administrateur/inscription_sportif/sportif_attente.php"> INSCRIPTION SPORTIF </a></li>
                <form method="post" action="../Administrateur/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal"> 
            <h1>QUESTIONS EN ATTENTE</h1>
            <table>
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Réponse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_pending->fetch_assoc()): ?>
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
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include('../PRESENTATION/bas_de_page.php');?>
</body>
</html>
