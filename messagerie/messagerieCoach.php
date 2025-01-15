<?php
session_start();
if (!isset($_SESSION['coach_id'])) {
    header('Location: ../COACH/connexion.php');
    exit();
}

include('../BDD/connexion.php');

// Récupérer l'ID du coach connecté
$coachId = $_SESSION['coach_id'];

// Récupérer le nombre de messages non lus
$unreadMessagesQuery = $conn->prepare('
    SELECT COUNT(*) AS unread_count 
    FROM messages 
    WHERE to_user_id = ? AND is_read = FALSE
');
$unreadMessagesQuery->bind_param('i', $coachId);
$unreadMessagesQuery->execute();
$unreadMessagesResult = $unreadMessagesQuery->get_result()->fetch_assoc();
$unreadCount = $unreadMessagesResult['unread_count'];

// Récupérer la liste des sportifs associés avec leurs messages non lus
$unreadSportifsQuery = $conn->prepare('
    SELECT s.id_sportif AS id, s.prenom, s.nom, COUNT(m.id) AS unread_count 
    FROM sportif s
    JOIN messages m ON m.from_user_id = s.id_sportif
    WHERE m.to_user_id = ? AND m.is_read = FALSE
    GROUP BY s.id_sportif, s.prenom, s.nom
');
$unreadSportifsQuery->bind_param('i', $coachId);
$unreadSportifsQuery->execute();
$unreadSportifs = $unreadSportifsQuery->get_result()->fetch_all(MYSQLI_ASSOC);

// Récupérer la liste des sportifs disponibles
$usersQuery = $conn->prepare('SELECT id_sportif AS id, prenom, nom FROM sportif');
$usersQuery->execute();
$sportifsList = $usersQuery->get_result()->fetch_all(MYSQLI_ASSOC);

// Ajouter une connexion entre le coach et un sportif
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sportif_id'])) {
    $sportifId = intval($_POST['sportif_id']);

    // Vérifier si la connexion existe déjà
    $checkConnectionQuery = $conn->prepare('SELECT * FROM coach_sportif WHERE coach_id = ? AND sportif_id = ?');
    $checkConnectionQuery->bind_param('ii', $coachId, $sportifId);
    $checkConnectionQuery->execute();
    $connectionExists = $checkConnectionQuery->get_result()->num_rows > 0;

    if (!$connectionExists) {
        // Créer la connexion entre le coach et le sportif
        $insertConnectionQuery = $conn->prepare('INSERT INTO coach_sportif (coach_id, sportif_id) VALUES (?, ?)');
        $insertConnectionQuery->bind_param('ii', $coachId, $sportifId);
        $insertConnectionQuery->execute();
    }
}

// Gestion des messages échangés
$messages = [];
$recipient = null;
if (isset($_GET['recipient'])) {
    $recipientId = intval($_GET['recipient']);

    // Vérifier que le sportif est associé au coach
    $checkRecipientQuery = $conn->prepare('SELECT prenom, nom FROM sportif WHERE id_sportif = ?');
    $checkRecipientQuery->bind_param('i', $recipientId);
    $checkRecipientQuery->execute();
    $recipient = $checkRecipientQuery->get_result()->fetch_assoc();

    if ($recipient) {
        // Récupérer les messages échangés
        $messagesQuery = $conn->prepare('
            SELECT from_user_id, to_user_id, content, created_at 
            FROM messages 
            WHERE (from_user_id = ? AND to_user_id = ?) 
               OR (from_user_id = ? AND to_user_id = ?)
            ORDER BY created_at ASC
        ');
        $messagesQuery->bind_param('iiii', $coachId, $recipientId, $recipientId, $coachId);
        $messagesQuery->execute();
        $messages = $messagesQuery->get_result()->fetch_all(MYSQLI_ASSOC);

        // Marquer les messages comme lus
        $markAsReadQuery = $conn->prepare('
            UPDATE messages 
            SET is_read = TRUE 
            WHERE to_user_id = ? AND from_user_id = ? AND is_read = FALSE
        ');
        $markAsReadQuery->bind_param('ii', $coachId, $recipientId);
        $markAsReadQuery->execute();
    }
}

// Envoyer un message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['to_user_id'], $_POST['message'])) {
    $toUserId = intval($_POST['to_user_id']);
    $content = htmlspecialchars(trim($_POST['message']));

    if (!empty($content)) {
        $insertMessageQuery = $conn->prepare('
            INSERT INTO messages (from_user_id, to_user_id, content) 
            VALUES (?, ?, ?)
        ');
        $insertMessageQuery->bind_param('iis', $coachId, $toUserId, $content);
        $insertMessageQuery->execute();
        header("Location: messagerieCoach.php?recipient=$toUserId");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie Coach</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Messagerie Coach</h1>

    <!-- Notification pop-up -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const unreadCount = <?php echo $unreadCount; ?>;
            if (unreadCount > 0) {
                const shouldRedirect = confirm(`Vous avez ${unreadCount} nouveau(x) message(s) non lu(s). Voulez-vous les consulter ?`);
                if (shouldRedirect) {
                    window.location.href = '#unread-messages';
                }
            }
        });
    </script>

    <!-- Ajouter une connexion avec un sportif -->
    <section>
        <h2>Ajouter une connexion avec un sportif</h2>
        <form method="POST" action="">
            <label for="sportif_id">Choisissez un sportif :</label>
            <select name="sportif_id" id="sportif_id" required>
                <option value="" disabled selected>-- Sélectionnez un sportif --</option>
                <?php foreach ($sportifsList as $sportif): ?>
                    <option value="<?php echo $sportif['id']; ?>">
                        <?php echo htmlspecialchars($sportif['prenom'] . ' ' . $sportif['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter la connexion</button>
        </form>
    </section>

    <!-- Liste des sportifs avec des messages non lus -->
    <section id="unread-messages">
        <h2>Sportifs avec des messages non lus</h2>
        <?php if (!empty($unreadSportifs)): ?>
            <ul>
                <?php foreach ($unreadSportifs as $sportif): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($sportif['prenom'] . ' ' . $sportif['nom']); ?></strong>
                        (<?php echo $sportif['unread_count']; ?> message(s) non lu(s))
                        <a href="messagerieCoach.php?recipient=<?php echo $sportif['id']; ?>">Voir les messages</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun message non lu.</p>
        <?php endif; ?>
    </section>

    <!-- Discussion avec un sportif -->
    <?php if ($recipient): ?>
        <section>
            <h2>Messages avec <?php echo htmlspecialchars($recipient['prenom'] . ' ' . $recipient['nom']); ?></h2>
            <div class="messages">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <div>
                            <strong><?php echo ($msg['from_user_id'] === $coachId) ? 'Vous' : 'Sportif'; ?>:</strong>
                            <p><?php echo htmlspecialchars($msg['content']); ?></p>
                            <em><?php echo htmlspecialchars($msg['created_at']); ?></em>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun message échangé pour l'instant.</p>
                <?php endif; ?>
            </div>
            <form method="POST">
                <input type="hidden" name="to_user_id" value="<?php echo $recipientId; ?>">
                <textarea name="message" placeholder="Votre message..." required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </section>
    <?php endif; ?>

    <footer>
        <div class="footer-container">
          <div class="footer-column">
            <h3>Nos Services</h3>
            <ul>
              <li><a href="#"> Service clientèle </a></li>
              <li><a href="#"> Réglement intérieur </a></li>
              <li><a href="#"> Heure d'ouverture </a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>À propos</h3>
            <ul>
              <li><a href="#"> Notre Histoire </a></li>
              <li><a href="../Mentionslégales/MentionsLégales.html"> Mentions Légales </a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Nos Lieux</h3>
            <ul>
                <li><a href="../Carte/Carte.html"> Aubervilliers </a></li>
                <li><a href="../Carte/Carte.html"> Boulogne-Billancourt </a></li>
                <li><a href="../Carte/Carte.html"> Châtillon </a></li>
                <li><a href="../Carte/Carte.html"> Colombes </a></li>
                <li><a href="../Carte/Carte.html"> Courbevoie </a></li>
                <li><a href="../Carte/Carte.html"> Créteil </a></li>
                <li><a href="../Carte/Carte.html"> Issy-les-Moulineaux </a></li>
                <li><a href="../Carte/Carte.html"> Massy </a></li>
                <li><a href="../Carte/Carte.html"> Meudon </a></li>
                <li><a href="../Carte/Carte.html"> Paris </a></li>
                <li><a href="../Carte/Carte.html"> Versailles </a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Nous Contacter</h3>
            <ul>
              <li> support@coachus.com </li>
              <li><a href="../FAQ/FAQ.html"> FAQ </a></li>
            </ul>
          </div>
        </div>
      
        <div class="footer-bottom">
          <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>


