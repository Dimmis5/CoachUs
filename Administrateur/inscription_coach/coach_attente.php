<?php
session_start();
include('../../BDD/connexion.php');

$result = $conn->query("SELECT * FROM inscriptions_coach_en_attente");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des inscriptions des coachs</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include('../PRESENTATION/haut_de_page.php');?>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="../../Administrateur/administrateur.php"> TABLEAU DE BORD</a></li>
                <li><a href="../../Administrateur/coach.php"> COACH </a></li>
                <li><a href="../../Administrateur/sportif.php"> SPORTIF </a></li>
                <li><a href="../../Administrateur/lieu.php"> LIEU </a></li>
                <li><a href="../../Administrateur/gestion_FAQ.php"> FAQ </a></li>
                <li><a href="../../Administrateur/inscription_coach/coach_attente.php"> INSCRIPTION COACH</a></li>
                <li><a href="../../Administrateur/inscription_sportif/sportif_attente.php"> INSCRIPTION SPORTIF</a></li>
                <form method="post" action="../../Administrateur/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">  
            <h1>COACHS EN ATTENTE D'INSCRIPTION </h1>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Numéro de téléphone</th>
                        <th>Adresse mail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['nom']); ?></td>
                            <td><?= htmlspecialchars($row['prenom']); ?></td>
                            <td><?= htmlspecialchars($row['adresse']); ?></td>
                            <td><?= htmlspecialchars($row['numero_de_telephone']); ?></td>
                            <td><?= htmlspecialchars($row['adresse_mail']); ?></td>
                            <td class="actions">
                                <a class="valider" href="../Administrateur/inscription_coach/valider_coach.php?id=<?= $row['id']; ?>">Valider</a>
                                <a class="rejeter" href="../Administrateur/inscription_coach/rejeter_coach.php?id=<?= $row['id']; ?>">Rejeter</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include('../PRESENTATION/bas_de_page.php');?>
</body>
</html>
