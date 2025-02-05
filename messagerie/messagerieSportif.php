<?php
session_start();
if (!isset($_SESSION['sportif_id'])) {
    header('Location: ../SPORTIF/connexion.php');
    exit();
}

include('../BDD/connexion.php');


$sportifId = $_SESSION['sportif_id'];


$coachsQuery = $conn->prepare('SELECT id_coach AS id, prenom, nom FROM coach');
$coachsQuery->execute();
$coachsList = $coachsQuery->get_result()->fetch_all(MYSQLI_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['coach_id'])) {
    $coachId = intval($_POST['coach_id']);

    
    $checkConnectionQuery = $conn->prepare('SELECT * FROM coach_sportif WHERE coach_id = ? AND sportif_id = ?');
    $checkConnectionQuery->bind_param('ii', $coachId, $sportifId);
    $checkConnectionQuery->execute();
    $connectionExists = $checkConnectionQuery->get_result()->num_rows > 0;

    if (!$connectionExists) {
        
        $insertConnectionQuery = $conn->prepare('INSERT INTO coach_sportif (coach_id, sportif_id) VALUES (?, ?)');
        $insertConnectionQuery->bind_param('ii', $coachId, $sportifId);
        $insertConnectionQuery->execute();
    }
}


$associatedQuery = $conn->prepare('
    SELECT c.id_coach AS id, c.prenom, c.nom 
    FROM coach c
    JOIN coach_sportif cs ON c.id_coach = cs.coach_id
    WHERE cs.sportif_id = ?
');
$associatedQuery->bind_param('i', $sportifId);
$associatedQuery->execute();
$associatedCoachs = $associatedQuery->get_result()->fetch_all(MYSQLI_ASSOC);


$messages = [];
$recipient = null;
if (isset($_GET['recipient'])) {
    $recipientId = intval($_GET['recipient']);

    
    $checkRecipientQuery = $conn->prepare('SELECT prenom, nom FROM coach WHERE id_coach = ?');
    $checkRecipientQuery->bind_param('i', $recipientId);
    $checkRecipientQuery->execute();
    $recipient = $checkRecipientQuery->get_result()->fetch_assoc();

    if ($recipient) {
        
        $messagesQuery = $conn->prepare('
            SELECT from_user_id, to_user_id, content, created_at 
            FROM messages 
            WHERE (from_user_id = ? AND to_user_id = ?) 
               OR (from_user_id = ? AND to_user_id = ?)
            ORDER BY created_at ASC
        ');
        $messagesQuery->bind_param('iiii', $sportifId, $recipientId, $recipientId, $sportifId);
        $messagesQuery->execute();
        $messages = $messagesQuery->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['to_user_id'], $_POST['message'])) {
    $toUserId = intval($_POST['to_user_id']);
    $content = htmlspecialchars(trim($_POST['message']));

    if (!empty($content)) {
        $insertMessageQuery = $conn->prepare('INSERT INTO messages (from_user_id, to_user_id, content) VALUES (?, ?, ?)');
        $insertMessageQuery->bind_param('iis', $sportifId, $toUserId, $content);
        if ($insertMessageQuery->execute()) {
            header("Location: messagerieSportif.php?recipient=$toUserId");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie Sportif</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Messagerie Sportif</h1>

    
    <section>
        <h2>Ajouter une connexion avec un coach</h2>
        <form method="POST" action="">
            <label for="coach_id">Choisissez un coach :</label>
            <select name="coach_id" id="coach_id" required>
                <option value="" disabled selected>-- Sélectionnez un coach --</option>
                <?php foreach ($coachsList as $coach): ?>
                    <option value="<?php echo $coach['id']; ?>">
                        <?php echo htmlspecialchars($coach['prenom'] . ' ' . $coach['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter la connexion</button>
        </form>
    </section>

    
    <section>
        <h2>Coachs associés</h2>
        <?php if (!empty($associatedCoachs)): ?>
            <ul>
                <?php foreach ($associatedCoachs as $coach): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($coach['prenom'] . ' ' . $coach['nom']); ?></strong>
                        <a href="messagerieSportif.php?recipient=<?php echo $coach['id']; ?>">Voir les messages</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun coach associé.</p>
        <?php endif; ?>
    </section>

    
    <?php if ($recipient): ?>
        <section>
            <h2>Messages avec <?php echo htmlspecialchars($recipient['prenom'] . ' ' . $recipient['nom']); ?></h2>
            <div class="messages">
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $msg): ?>
                        <div>
                            <strong><?php echo ($msg['from_user_id'] === $sportifId) ? 'Vous' : 'Coach'; ?>:</strong>
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
