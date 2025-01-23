<?php
include('../BDD/connexion.php');

$successMessage = ""; // Variable pour stocker le message de succès

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $reponse = isset($_POST['reponse']) ? $_POST['reponse'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    if ($id && $reponse && $category) {
        // Déplacer la question vers la table appropriée
        $table = $category === 'sportif' ? 'faq_sportif' : 'faq_coach';

        // Récupérer la question depuis faq_pending
        $query_pending = "SELECT question FROM faq_pending WHERE id = ?";
        $stmt_pending = $conn->prepare($query_pending);
        $stmt_pending->bind_param("i", $id);
        $stmt_pending->execute();
        $result = $stmt_pending->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $question = $row['question'];

            // Insérer dans la table finale
            $query_insert = "INSERT INTO $table (question, reponse) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("ss", $question, $reponse);
            $stmt_insert->execute();

            // Supprimer de faq_pending
            $query_delete = "DELETE FROM faq_pending WHERE id = ?";
            $stmt_delete = $conn->prepare($query_delete);
            $stmt_delete->bind_param("i", $id);
            $stmt_delete->execute();

            // Définir le message de succès
            $successMessage = "Question ajoutée avec succès.";
        } else {
            $successMessage = "Erreur : Question non trouvée.";
        }
    } else {
        $successMessage = "Erreur : Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <style>
        /* Styles pour la pop-up */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            z-index: 1000;
            text-align: center;
            width: 300px;
        }
        .popup.active {
            display: block;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .popup-overlay.active {
            display: block;
        }
        .popup button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .popup button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include('../PRESENTATION/haut_de_page.php');?>
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popup">
        <p id="popupMessage"></p>
        <button onclick="closePopup()">OK</button>
    </div>

    <!-- Script pour gérer la pop-up -->
    <script>
        function showPopup(message) {
            document.getElementById('popupMessage').textContent = message;
            document.getElementById('popup').classList.add('active');
            document.getElementById('popupOverlay').classList.add('active');
        }

        function closePopup() {
            document.getElementById('popup').classList.remove('active');
            document.getElementById('popupOverlay').classList.remove('active');
        }

        // Afficher la pop-up si un message de succès est défini
        <?php if (!empty($successMessage)): ?>
            showPopup("<?= htmlspecialchars($successMessage) ?>");
        <?php endif; ?>
    </script>
        <?php include('../PRESENTATION/bas_de_page.php');?>
</body>
</html>
