<?php
include('../BDD/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'supprimer_lieu_temp' && isset($_POST['lieu-temp-id'])) {
            $lieu_temp_id = $_POST['lieu-temp-id'];
            $query = "DELETE FROM lieux_temp WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $lieu_temp_id);
            $stmt->execute();
            $stmt->close();
        } elseif ($action === 'ajouter_lieu' && isset($_POST['lieu-temp-id'], $_POST['nombre-places'], $_POST['latitude'], $_POST['longitude'])) {
            $lieu_temp_id = $_POST['lieu-temp-id'];
            $nombre_places = $_POST['nombre-places'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            // Récupérer les informations du lieu temporaire
            $query = "SELECT nom, adresse FROM lieux_temp WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $lieu_temp_id);
            $stmt->execute();
            $stmt->bind_result($nom, $adresse);
            $stmt->fetch();
            $stmt->close();

            // Insérer dans la table lieu
            $query = "INSERT INTO lieu (nom, adresse, nombre_places_disponibles, latitude, longitude) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssidd", $nom, $adresse, $nombre_places, $latitude, $longitude);
            $stmt->execute();
            $stmt->close();

            // Supprimer le lieu temporaire
            $query = "DELETE FROM lieux_temp WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $lieu_temp_id);
            $stmt->execute();
            $stmt->close();
        } elseif ($action === 'modifier_lieu_temp' && isset($_POST['lieu-temp-id'], $_POST['nouveau-nom'], $_POST['nouvelle-adresse'])) {
            $lieu_temp_id = $_POST['lieu-temp-id'];
            $nouveau_nom = $_POST['nouveau-nom'];
            $nouvelle_adresse = $_POST['nouvelle-adresse'];

            $query = "UPDATE lieux_temp SET nom = ?, adresse = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $nouveau_nom, $nouvelle_adresse, $lieu_temp_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$lieu_temp = [];
$query_lieu_temp = "SELECT * FROM lieux_temp";
$result_lieu_temp = $conn->query($query_lieu_temp);
if ($result_lieu_temp && $result_lieu_temp->num_rows > 0) {
    while ($row = $result_lieu_temp->fetch_assoc()) {
        $lieu_temp[] = $row;
    }
}

$lieu = [];
$query_lieu = "SELECT * FROM lieu";
$result_lieu = $conn->query($query_lieu);
if ($result_lieu && $result_lieu->num_rows > 0) {
    while ($row = $result_lieu->fetch_assoc()) {
        $lieu[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <link rel="stylesheet" href="../style2.css">
    <script>
        function filterTable(input, columnIndex) {
            const filter = input.value.toLowerCase();
            const table = document.querySelector("table tbody");
            const rows = table.querySelectorAll("tr");

            rows.forEach(row => {
                const cell = row.cells[columnIndex];
                if (cell && cell.textContent.toLowerCase().includes(filter)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="../Administrateur/administrateur.php"> TABLEAU DE BORD</a></li>
                <li><a href="../Administrateur/coach.php"> COACH </a></li>
                <li><a href="../Administrateur/sportif.php"> SPORTIF </a></li>
                <li><a href="../Administrateur/lieu.php"> LIEU </a></li>
            </ul>
        </div>
        
        <div class="contenu-principal">
            <h1>BIENVENUE</h1>
            <section id="lieux-en-attente">
                <div class="encadrer encadrer-modification">
                    <h2>LIEUX EN ATTENTE D'AJOUT</h2>
                    <?php if (!empty($lieu_temp)): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Ajouter</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lieu_temp as $temp): ?>
                                    <tr>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="lieu-temp-id" value="<?= $temp['id'] ?>">
                                                <input type="hidden" name="action" value="modifier_lieu_temp">
                                                <input type="text" name="nouveau-nom" value="<?= htmlspecialchars($temp['nom']) ?>" required>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="lieu-temp-id" value="<?= $temp['id'] ?>">
                                                <input type="hidden" name="action" value="modifier_lieu_temp">
                                                <input type="text" name="nouvelle-adresse" value="<?= htmlspecialchars($temp['adresse']) ?>" required>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="lieu-temp-id" value="<?= $temp['id'] ?>">
                                                <input type="hidden" name="action" value="ajouter_lieu">
                                                <input type="number" name="nombre-places" placeholder="Places disponibles" required>
                                                <input type="text" name="latitude" placeholder="Latitude" required>
                                                <input type="text" name="longitude" placeholder="Longitude" required>
                                                <button type="submit">Ajouter</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="lieu-temp-id" value="<?= $temp['id'] ?>">
                                                <input type="hidden" name="action" value="supprimer_lieu_temp">
                                                <button type="submit">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucun lieu en attente d'ajout.</p>
                    <?php endif; ?>
                </div>
            </section>

            <section id="lieux">
                <div class="encadrer encadrer-modification">
                    <h2>GESTION DES LIEUX</h2>
                    <?php if (!empty($lieu)): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom<br><input type="text" onkeyup="filterTable(this, 0)" placeholder="Rechercher..."></th>
                                    <th>Adresse<br><input type="text" onkeyup="filterTable(this, 1)" placeholder="Rechercher..."></th>
                                    <th>Nombres de places disponibles<br><input type="text" onkeyup="filterTable(this, 2)" placeholder="Rechercher..."></th>
                                    <th>Latitude<br><input type="text" onkeyup="filterTable(this, 3)" placeholder="Rechercher..."></th>
                                    <th>Longitude<br><input type="text" onkeyup="filterTable(this, 4)" placeholder="Rechercher..."></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lieu as $l): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($l['nom']) ?></td>
                                        <td><?= htmlspecialchars($l['adresse']) ?></td>
                                        <td><?= htmlspecialchars($l['nombre_places_disponibles']) ?></td>
                                        <td><?= htmlspecialchars($l['latitude']) ?></td>
                                        <td><?= htmlspecialchars($l['longitude']) ?></td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="lieu-id" value="<?= $l['id_lieu'] ?>">
                                                <input type="hidden" name="action" value="supprimer_lieu">
                                                <button type="submit">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucun lieu disponible.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
