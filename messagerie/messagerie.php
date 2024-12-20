<?php
session_start();
require 'bdd.php';  // Connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');  // Rediriger si non connecté
    exit;
}

$pseudo = $_SESSION['pseudo'];

// Récupérer les informations de l'utilisateur connecté
$currentUserQuery = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
$currentUserQuery->execute([$pseudo]);
$user = $currentUserQuery->fetch();

if (!$user) {
    echo "Erreur : utilisateur introuvable.";
    exit;
}

// Récupérer les coachs ou sportifs associés selon le rôle
if ($user['role'] === 'coach') {
    $query = $bdd->prepare('
        SELECT u.* FROM users u
        JOIN coach_sportif cs ON u.id = cs.sportif_id
        WHERE cs.coach_id = ?
    ');
    $query->execute([$user['id']]);
} else {
    $query = $bdd->prepare('
        SELECT u.* FROM users u
        JOIN coach_sportif cs ON u.id = cs.coach_id
        WHERE cs.sportif_id = ?
    ');
    $query->execute([$user['id']]);
}
$usersList = $query->fetchAll();

// Gestion de l'envoi d'un message
if (isset($_POST['envoyer'])) {
    $to_user_id = $_POST['to_user_id'];
    $message = htmlspecialchars(trim($_POST['message']));

    // Vérifier si le destinataire est valide
    $recipientQuery = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $recipientQuery->execute([$to_user_id]);
    $recipient = $recipientQuery->fetch();

    if ($recipient && !empty($message)) {
        $insertMessage = $bdd->prepare('INSERT INTO messages (from_user_id, to_user_id, content) VALUES (?, ?, ?)');
        $insertMessage->execute([$user['id'], $to_user_id, $message]);
    } else {
        echo "Erreur : message invalide ou destinataire introuvable.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylem.css">
    <title>Messagerie</title>
</head>
<body>
    <h2>Messagerie</h2>

    <!-- Liste des utilisateurs associés -->
    <h3>Choisissez un utilisateur pour discuter :</h3>
    <ul>
        <?php foreach ($usersList as $recipient) { ?>
            <li>
                <a href="messagerie.php?recipient=<?php echo htmlspecialchars($recipient['id']); ?>">
                    <?php echo htmlspecialchars($recipient['pseudo']); ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <?php
    // Afficher les messages avec le destinataire sélectionné
    if (isset($_GET['recipient'])) {
        $recipient_id = intval($_GET['recipient']);

        // Vérifier si le destinataire existe
        $recipientQuery = $bdd->prepare('SELECT * FROM users WHERE id = ?');
        $recipientQuery->execute([$recipient_id]);
        $recipient = $recipientQuery->fetch();

        if ($recipient) {
            // Récupérer les messages échangés avec cet utilisateur
            $messagesQuery = $bdd->prepare('
                SELECT * FROM messages 
                WHERE (from_user_id = :current AND to_user_id = :recipient) 
                   OR (from_user_id = :recipient AND to_user_id = :current)
                ORDER BY created_at DESC
            ');
            $messagesQuery->execute(['current' => $user['id'], 'recipient' => $recipient_id]);
            $messages = $messagesQuery->fetchAll();
    ?>
            <h3>Messages avec <?php echo htmlspecialchars($recipient['pseudo']); ?></h3>
            <div class="messages">
                <?php foreach ($messages as $msg) { ?>
                    <div>
                        <strong><?php echo htmlspecialchars($msg['from_user_id'] == $user['id'] ? $user['pseudo'] : $recipient['pseudo']); ?>:</strong>
                        <p><?php echo htmlspecialchars($msg['content']); ?></p>
                    </div>
                <?php } ?>
            </div>
                    
            <!-- Formulaire d'envoi de message -->
            <form method="POST">
                <input type="hidden" name="to_user_id" value="<?php echo $recipient_id; ?>">
                <textarea name="message" placeholder="Votre message..." required></textarea>
                <button type="submit" name="envoyer">Envoyer</button>
            </form>
    <?php
        } else {
            echo "<p>Erreur : utilisateur non trouvé.</p>";
        }
    }
    ?>

    <a href="deconnexion.php">Déconnexion</a>
</body>
</html>
