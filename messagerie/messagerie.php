<?php
session_start();
require 'bdd.php'; // Connexion à la base de données


if (!isset($_SESSION['role']) || (!isset($_SESSION['id_coach']) && !isset($_SESSION['id_sportif']))) {
    header('Location: ../index.php');
    exit;
}


$role = $_SESSION['role'];
$id = $role === 'coach' ? $_SESSION['id_coach'] : $_SESSION['id_sportif'];


if ($role === 'coach') {

    $query = $bdd->prepare('
        SELECT s.id_sportif AS id, s.identifiant AS pseudo
        FROM sportif s
        JOIN coach_sportif cs ON s.id_sportif = cs.id_sportif
        WHERE cs.id_coach = ?
    ');
    $query->execute([$id]);
} else {

    $query = $bdd->prepare('
        SELECT c.id_coach AS id, c.identifiant AS pseudo
        FROM coach c
        JOIN coach_sportif cs ON c.id_coach = cs.id_coach
        WHERE cs.id_sportif = ?
    ');
    $query->execute([$id]);
}
$usersList = $query->fetchAll();

if (isset($_GET['recipient'])) {
    $recipientId = intval($_GET['recipient']);
    $recipientRole = $role === 'coach' ? 'sportif' : 'coach';

    $messagesQuery = $bdd->prepare('
        SELECT * FROM messages
        WHERE (from_user_id = :current AND to_user_id = :recipient AND from_user_type = :current_type AND to_user_type = :recipient_type)
           OR (from_user_id = :recipient AND to_user_id = :current AND from_user_type = :recipient_type AND to_user_type = :current_type)
        ORDER BY created_at
    ');
    $messagesQuery->execute([
        'current' => $id,
        'recipient' => $recipientId,
        'current_type' => $role,
        'recipient_type' => $recipientRole,
    ]);
    $messages = $messagesQuery->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'], $_POST['recipient_id'])) {
    $recipientId = intval($_POST['recipient_id']);
    $content = htmlspecialchars(trim($_POST['message']));
    $recipientRole = $role === 'coach' ? 'sportif' : 'coach';

    if (!empty($content)) {
        $insertMessage = $bdd->prepare('
            INSERT INTO messages (from_user_id, to_user_id, from_user_type, to_user_type, content)
            VALUES (?, ?, ?, ?, ?)
        ');
        $insertMessage->execute([$id, $recipientId, $role, $recipientRole, $content]);
        header("Location: messagerie.php?recipient=$recipientId");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messagerie</title>
</head>
<body>
    <h2>Messagerie Privée</h2>

    <h3>Liste des utilisateurs associés :</h3>
    <ul>
        <?php foreach ($usersList as $user) { ?>
            <li>
                <a href="messagerie.php?recipient=<?php echo $user['id']; ?>">
                    <?php echo htmlspecialchars($user['pseudo']); ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <?php if (isset($messages)) { ?>
        <h3>Messages échangés :</h3>
        <div>
            <?php foreach ($messages as $message) { ?>
                <p><strong><?php echo $message['from_user_type'] === $role ? 'Vous' : 'Lui'; ?>:</strong>
                <?php echo htmlspecialchars($message['content']); ?></p>
            <?php } ?>
        </div>
        <form method="POST">
            <textarea name="message" placeholder="Écrivez votre message..." required></textarea>
            <input type="hidden" name="recipient_id" value="<?php echo $recipientId; ?>">
            <button type="submit">Envoyer</button>
        </form>
    <?php } ?>
    
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
