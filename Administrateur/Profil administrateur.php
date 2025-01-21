<?php
ini_set('display_errors', 1); // Affichage des erreurs pour le diagnostic
error_reporting(E_ALL); // Tous les types d'erreurs sont affichés

include('../BDD/connexion.php');

// Gestion des statistiques des utilisateurs
try {
    $query_sportifs = "SELECT COUNT(*) AS total_sportifs FROM sportif";
    $result_sportifs = $conn->query($query_sportifs);
    $row_sportifs = $result_sportifs->fetch_assoc();
    $total_sportifs = $row_sportifs['total_sportifs'];

    $query_coachs = "SELECT COUNT(*) AS total_coachs FROM coach";
    $result_coachs = $conn->query($query_coachs);
    $row_coachs = $result_coachs->fetch_assoc();
    $total_coachs = $row_coachs['total_coachs'];

    $total_inscrits = $total_sportifs + $total_coachs;
} catch (mysqli_sql_exception $e) {
    die("Erreur lors de l'exécution des requêtes : " . $e->getMessage());
}

// Récupérer les lieux en attente
$query = "SELECT * FROM lieux_temp WHERE statut = 'en_attente'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $locations = [];
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
} else {
    $locations = [];
}

// Traitement des actions sur les lieux
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $location_id = $_POST['location-id'];

        // Suppression du lieu
        if ($_POST['action'] === 'supprimer') {
            $delete_query = "DELETE FROM lieux_temp WHERE id = ?";
            $stmt_delete = $conn->prepare($delete_query);
            $stmt_delete->bind_param("i", $location_id);

            if ($stmt_delete->execute()) {
                echo "<script>alert('Le lieu a été supprimé avec succès.'); window.location.href='gestion_lieu.php';</script>";
            } else {
                echo "<script>alert('Erreur lors de la suppression du lieu.'); window.location.href='gestion_lieu.php';</script>";
            }
            $stmt_delete->close();
        }

        // Ajout du lieu dans la table 'lieu'
        if ($_POST['action'] === 'ajouter') {
            $location_places = $_POST['location-places'];
            $location_latitude = $_POST['location-latitude'];
            $location_longitude = $_POST['location-longitude'];

            $insert_query = "INSERT INTO lieu (nom, adresse, nombre_places_disponibles, latitude, longitude)
                             SELECT nom, adresse, ?, ?, ? FROM lieux_temp WHERE id = ?";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param("dssi", $location_places, $location_latitude, $location_longitude, $location_id);
            
            if ($stmt_insert->execute()) {
                $delete_query = "DELETE FROM lieux_temp WHERE id = ?";
                $stmt_delete = $conn->prepare($delete_query);
                $stmt_delete->bind_param("i", $location_id);
                $stmt_delete->execute();

                echo "<script>alert('Le lieu a été ajouté dans la base de données et supprimé de la liste en attente.'); window.location.href='gestion_lieu.php';</script>";
            } else {
                echo "<script>alert('Erreur lors de l\'ajout du lieu dans la base de données.'); window.location.href='gestion_lieu.php';</script>";
            }

            $stmt_insert->close();
            $stmt_delete->close();
        }

        // Action modifier : on récupère les données du lieu
        if ($_POST['action'] === 'modifier' && isset($_POST['location-id'])) {
            $location_id = $_POST['location-id'];
            $query_location = "SELECT * FROM lieux_temp WHERE id = ?";
            $stmt_location = $conn->prepare($query_location);
            $stmt_location->bind_param("i", $location_id);
            $stmt_location->execute();
            $result_location = $stmt_location->get_result();

            // Vérifier si le lieu existe et le récupérer
            if ($result_location->num_rows > 0) {
                $location = $result_location->fetch_assoc();
            } else {
                echo "<script>alert('Lieu introuvable.'); window.location.href='gestion_lieu.php';</script>";
                exit;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Lieux</title>
    <link rel="stylesheet" href="../style2.css">
    <style>
        /* Styles du pop-up */
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        .popup button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
        </div>

        <div class="contenu-principal">
            <h1 align="center">BIENVENUE !</h1>

            <div class="encadrer encadrer-modification">
                <h2>STATISTIQUES GLOBALES </h2>
                <ul>
                    <li>Nombre total d'inscrits : <strong><?php echo $total_inscrits; ?></strong></li>
                    <li>Nombre total de sportifs inscrits : <strong><?php echo $total_sportifs; ?></strong></li>
                    <li>Nombre total de coachs inscrits : <strong><?php echo $total_coachs; ?></strong></li>
                </ul>
            </div>
            <br>
            <div class="encadrer encadrer-modification">
                <h2>GESTION DES UTILISATEURS</h2>
                <ul>
                    <li><a href="../Administrateur/gere_sportif.php?type=sportif">Gérer les sportifs</a></li>
                    <li><a href="../Administrateur/gere_coach.php?type=coach">Gérer les coachs</a></li>
                    <li><a href="../Inscription/inscriptionsportif.php">Ajouter un sportif</a></li>
                    <li><a href="../Inscription/inscriptioncoach.php">Ajouter un coach</a></li>
                </ul>
            </div>
            <br>

            <!-- Tableau des lieux en attente -->
            <div class="encadrer encadrer-modification">
                <h2>GESTION DES LIEUX</h2>
                <?php if (!empty($locations)): ?>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Nom du lieu</th>
                                <th>Adresse</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($locations as $location): ?>
                                <tr>
                                    <form action="gestion_lieu.php" method="POST">
                                        <td><?php echo htmlspecialchars($location['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($location['adresse']); ?></td>
                                        <td>
                                            <button type="submit" name="action" value="supprimer">Supprimer</button>
                                            <button type="submit" name="action" value="modifier">Modifier</button>
                                        </td>
                                        <input type="hidden" name="location-id" value="<?php echo $location['id']; ?>">
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucun lieu en attente.</p>
                <?php endif; ?>
            </div>

            <!-- Formulaire de modification du lieu, affiché seulement si on a cliqué sur "Modifier" -->
            <?php if (isset($location)): ?>
                <h2>Modifier le lieu</h2>
                <form action="gestion_lieu.php" method="POST">
                    <input type="hidden" name="location-id" value="<?php echo $location['id']; ?>">
                    <label for="location-name">Nom du lieu:</label><br>
                    <input type="text" id="location-name" name="location-name" value="<?php echo $location['nom']; ?>" required><br>

                    <label for="location-address">Adresse:</label><br>
                    <input type="text" id="location-address" name="location-address" value="<?php echo $location['adresse']; ?>" required><br>

                    <label for="location-places">Nombre de places disponibles:</label><br>
                    <input type="number" id="location-places" name="location-places" required><br>

                    <label for="location-latitude">Latitude:</label><br>
                    <input type="text" id="location-latitude" name="location-latitude" required><br>

                    <label for="location-longitude">Longitude:</label><br>
                    <input type="text" id="location-longitude" name="location-longitude" required><br>

                    <button type="submit" name="action" value="ajouter">Ajouter</button>
                </form>
            <?php endif; ?>

            <!-- Pop-up pour la confirmation de suppression -->
            <div id="popup-supprimer" class="popup">
                <div class="popup-content">
                    <h3>Êtes-vous sûr de vouloir supprimer ce lieu ?</h3>
                    <form action="gestion_lieu.php" method="POST">
                        <input type="hidden" name="location-id" id="popup-location-id">
                        <button type="submit" name="action" value="supprimer">Oui</button>
                        <button type="button" onclick="closePopup()">Non</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour ouvrir le pop-up
        function openPopup(locationId) {
            document.getElementById('popup-supprimer').style.display = 'flex';
            document.getElementById('popup-location-id').value = locationId;
        }

        // Fonction pour fermer le pop-up
        function closePopup() {
            document.getElementById('popup-supprimer').style.display = 'none';
        }
    </script>
</body>
</html>
