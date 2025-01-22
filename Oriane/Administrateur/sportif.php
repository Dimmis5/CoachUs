<?php

include('../BDD/connexion.php');

$sportifs = [];


$query_sportifs = "SELECT * FROM sportif";
$result_sportifs = $conn->query($query_sportifs);
if ($result_sportifs && $result_sportifs->num_rows > 0) {
    while ($row = $result_sportifs->fetch_assoc()) {
        $sportifs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>
    <link rel="stylesheet" href="../style.css">
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
            <section id="sportif">
                <div class="encadrer encadrer-modification">
                    <h2>GESTION DES SPORTIFS</h2>
                    <?php if (!empty($sportifs)): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom<br><input type="text" onkeyup="filterTable(this, 0)" placeholder="Rechercher..."></th>
                                    <th>Prénom<br><input type="text" onkeyup="filterTable(this, 1)" placeholder="Rechercher..."></th>
                                    <th>Adresse<br><input type="text" onkeyup="filterTable(this, 2)" placeholder="Rechercher..."></th>
                                    <th>Numéro de téléphone<br><input type="text" onkeyup="filterTable(this, 3)" placeholder="Rechercher..."></th>
                                    <th>Adresse mail<br><input type="text" onkeyup="filterTable(this, 4)" placeholder="Rechercher..."></th>
                                    <th>Identifiant<br><input type="text" onkeyup="filterTable(this, 5)" placeholder="Rechercher..."></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sportifs as $sportif): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($sportif['nom']) ?></td>
                                        <td><?= htmlspecialchars($sportif['prenom']) ?></td>
                                        <td><?= htmlspecialchars($sportif['adresse']) ?></td>
                                        <td><?= htmlspecialchars($sportif['numero_de_telephone']) ?></td>
                                        <td><?= htmlspecialchars($sportif['adresse_mail']) ?></td>
                                        <td><?= htmlspecialchars($sportif['identifiant']) ?></td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="sportif-id" value="<?= $sportif['id_sportif'] ?>">
                                                <input type="hidden" name="action" value="supprimer_sportif">
                                                <button type="submit">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucun sportif disponible.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</body>                
</html>