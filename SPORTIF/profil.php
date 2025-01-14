<?php
session_start();
if (!isset($_SESSION['sportif_id'])) {
    header('Location: ../SPORTIF/connexion.php');
    exit();
}

include('../BDD/connexion.php');
include('../REQUETES_SPORTIF/informations.php');
include('../REQUETES_SPORTIF/modifier_informations.php');
include('../REQUETES_SPORTIF/recherchecreneau.php');
include('../REQUETES_SPORTIF/messagerie.php'); // Inclure le fichier pour récupérer les messages
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sportif</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="#modifier-infos">MODIFIER MES INFORMATIONS</a></li>
                <li><a href="#reserver-creneau"> RESERVER UN CRENEAU </a></li>
                <li><a href="#reservations"> MES RESERVATIONS </a></li>
                <li><a href="#messagerie">MESSAGERIE</a></li>
                <form method="post" action="../SPORTIF/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">
            <h1>BIENVENUE <?php echo htmlspecialchars($sportif['prenom']); ?> <?php echo htmlspecialchars($sportif['nom']); ?> ! </h1>
            
            <!-- Section Modifier Mes Informations -->
            <section id="modifier-infos">
                <div class="encadrer encadrer-modification">
                    <h2>MODIFIER MES INFORMATIONS</h2>
                    <!-- Code pour modifier les informations -->
                </div>
            </section>

            <!-- Section Réserver un Créneau -->
            <section id="reserver-creneau">
                <div class="encadrer encadrer-modification">
                    <h2>RESERVER UN CRENEAU</h2>
                    <!-- Code pour réserver un créneau -->
                </div>
            </section>

            <!-- Section Messagerie -->
            <section id="messagerie">
                <div class="encadrer encadrer-modification">
                    <h2>MESSAGERIE</h2>
                    <form method="POST" action="../SPORTIF/envoyer_message.php">
                        <label for="destinataire">Destinataire :</label>
                        <select name="destinataire" id="destinataire">
                            <option value="" disabled selected>Sélectionnez un utilisateur</option>
                            <?php foreach ($utilisateurs as $utilisateur): ?>
                                <option value="<?= $utilisateur['id'] ?>">
                                    <?= htmlspecialchars($utilisateur['prenom']) . ' ' . htmlspecialchars($utilisateur['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="message">Message :</label>
                        <textarea id="message" name="message" rows="4" cols="50" placeholder="Écrivez votre message..."></textarea>

                        <button type="submit">Envoyer</button>
                    </form>

                    <h3>Messages reçus :</h3>
                    <ul class="messages-list">
                        <?php foreach ($messagesRecus as $message): ?>
                            <li>
                                <strong><?= htmlspecialchars($message['expediteur_nom']) ?> :</strong>
                                <?= htmlspecialchars($message['contenu']) ?>
                                <em>(<?= $message['date_envoi'] ?>)</em>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
