<?php
include('../BDD/connexion.php');

// Initialisation des variables
$search = isset($_GET['search']) ? $_GET['search'] : '';
$faqs_sportifs = [];
$faqs_coachs = [];
$question_submitted = false; // Variable pour indiquer si une question a été soumise

// Vérifiez si une question a été soumise
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question']) && isset($_POST['category'])) {
    $question = trim($_POST['question']);
    $category = trim($_POST['category']);

    // Ajoutez le code ici pour insérer la question dans une table temporaire ou pour la traiter selon vos besoins.
    // Par exemple :
    $stmt = $conn->prepare("INSERT INTO faq_pending (question, category) VALUES (?, ?)");
    $stmt->bind_param("ss", $question, $category);
    if ($stmt->execute()) {
        $question_submitted = true; // Définir la confirmation
    }
    $stmt->close();
}

// Récupération des FAQs pour les sportifs (avec recherche)
$query_sportifs = "SELECT question, reponse FROM faq_sportif WHERE question LIKE ? OR reponse LIKE ?";
$stmt_sportifs = $conn->prepare($query_sportifs);
$search_param = '%' . $search . '%';
$stmt_sportifs->bind_param("ss", $search_param, $search_param);
$stmt_sportifs->execute();
$result_sportifs = $stmt_sportifs->get_result();
if ($result_sportifs && $result_sportifs->num_rows > 0) {
    while ($row = $result_sportifs->fetch_assoc()) {
        $faqs_sportifs[] = $row;
    }
}

// Récupération des FAQs pour les coachs (avec recherche)
$query_coachs = "SELECT question, reponse FROM faq_coach WHERE question LIKE ? OR reponse LIKE ?";
$stmt_coachs = $conn->prepare($query_coachs);
$stmt_coachs->bind_param("ss", $search_param, $search_param);
$stmt_coachs->execute();
$result_coachs = $stmt_coachs->get_result();
if ($result_coachs && $result_coachs->num_rows > 0) {
    while ($row = $result_coachs->fetch_assoc()) {
        $faqs_coachs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FAQ/FAQ.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const questions = document.querySelectorAll(".question");
            const toggleBtns = document.querySelectorAll(".toggle-btn");
            const faqSections = document.querySelectorAll(".faq-section");

            questions.forEach(question => {
                question.addEventListener("click", () => {
                    const answer = question.nextElementSibling;
                    const isVisible = answer.style.display === "block";
                    answer.style.display = isVisible ? "none" : "block";
                });
            });

            toggleBtns.forEach((tab, index) => {
                tab.addEventListener("click", () => {
                    toggleBtns.forEach(t => t.classList.remove("active"));
                    faqSections.forEach(section => section.classList.remove("active"));

                    tab.classList.add("active");
                    faqSections[index].classList.add("active");
                });
            });

            // Afficher un pop-up si une question a été soumise
            <?php if ($question_submitted): ?>
            alert("Votre question a été enregistrée avec succès !");
            <?php endif; ?>
        });
    </script>
</head>
<body>
    <div class="header-container">
        <div align="left">
            <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
            <img src="../LOGO/CoachUS.png" class="logo" alt="logo" width="250" height="70" />
        </div>
        <div align="right" class="button-container">
            <button><a href="../FAQ/FAQ.php">?</a></button>
            <button><a href="../SPORTIF/profil.php">JE VEUX UN COACH</a></button>
            <button><a href="../COACH/profil.php">JE SUIS COACH</a></button>
        </div>
    </div>

    <div class="intro-text">
        De quelle manière pouvons-nous vous accompagner ?
    </div>
    <div class="search-bar">
        <form method="get" action="">
            <input type="text" name="search" placeholder="Rechercher" value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>

    <div class="container">
        <div class="toggle-btns">
            <button class="toggle-btn active">Sportifs</button>
            <button class="toggle-btn">Coachs</button>
        </div>

        <div class="faq-section active">
            <h2>Sportifs</h2>
            <?php if (!empty($faqs_sportifs)): ?>
                <?php foreach ($faqs_sportifs as $faq): ?>
                    <div class="faq">
                        <div class="question"><?= htmlspecialchars($faq['question']) ?></div>
                        <div class="answer" style="display: none;"><?= htmlspecialchars($faq['reponse']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun résultat trouvé pour les sportifs.</p>
            <?php endif; ?>

            <div class="question">
                <h3>Vous n'avez pas trouvé la réponse ? Posez votre question :</h3>
                <form action="" method="post">
                    <label for="question_sportif">Votre question :</label><br>
                    <textarea id="question_sportif" name="question" rows="4" cols="50" placeholder="Écrivez votre question ici..." required></textarea><br>
                    <input type="hidden" name="category" value="sportif">
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>

        <div class="faq-section">
            <h2>Coachs</h2>
            <?php if (!empty($faqs_coachs)): ?>
                <?php foreach ($faqs_coachs as $faq): ?>
                    <div class="faq">
                        <div class="question"><?= htmlspecialchars($faq['question']) ?></div>
                        <div class="answer" style="display: none;"><?= htmlspecialchars($faq['reponse']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun résultat trouvé pour les coachs.</p>
            <?php endif; ?>

            <div class="question">
                <h3>Vous n'avez pas trouvé la réponse ? Posez votre question :</h3>
                <form action="" method="post">
                    <label for="question_coach">Votre question :</label><br>
                    <textarea id="question_coach" name="question" rows="4" cols="50" placeholder="Écrivez votre question ici..." required></textarea><br>
                    <input type="hidden" name="category" value="coach">
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include('../PRESENTATION/bas_de_page.php');?>
</html>
