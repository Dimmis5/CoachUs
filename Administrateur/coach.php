<?php
include('../BDD/connexion.php');

$coachs = [];

$query_coachs = "SELECT * FROM coach";
$result_coachs = $conn->query($query_coachs);
if ($result_coachs && $result_coachs->num_rows > 0) {
    while ($row = $result_coachs->fetch_assoc()) {
        $coachs[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Administrateur </title>
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
                <li><a href="../Administrateur/gestion_FAQ.php"> FAQ </a></li>
                <li><a href="../Administrateur/inscription_coach/coach_attente.php"> INSCRIPTION COACH </a></li>
                <li><a href="../Administrateur/inscription_sportif/sportif_attente.php"> INSCRIPTION SPORTIF </a></li>
                <form method="post" action="../Administrateur/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">
            <h1>BIENVENUE</h1>
            <section id="coach">
                <div class="encadrer encadrer-modification">
                    <h2>GESTION DES COACHS</h2>
                    <?php if (!empty($coachs)): ?>
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
                                <?php foreach ($coachs as $coach): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($coach['nom']) ?></td>
                                        <td><?= htmlspecialchars($coach['prenom']) ?></td>
                                        <td><?= htmlspecialchars($coach['adresse']) ?></td>
                                        <td><?= htmlspecialchars($coach['numero_de_telephone']) ?></td>
                                        <td><?= htmlspecialchars($coach['adresse_mail']) ?></td>
                                        <td><?= htmlspecialchars($coach['identifiant']) ?></td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="coach-id" value="<?= $coach['id_coach'] ?>">
                                                <input type="hidden" name="action" value="supprimer_coach">
                                                <button type="submit">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Aucun coach disponible.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</body>                
</html>