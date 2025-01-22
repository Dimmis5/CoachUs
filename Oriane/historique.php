<?php
session_start();
if (!isset($_SESSION['sportif_id'])) {
    header('Location: ../SPORTIF/connexion.php');
    exit();
}

include('../BDD/connexion.php');
include('../REQUETES_SPORTIF/historique.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Reservations</title>
    <link rel="stylesheet" href="../style2.css">
</head>
<body>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="../SPORTIF/profil.php#modifier-infos.php">MODIFIER MES INFORMATIONS</a></li>
                <li><a href="../SPORTIF/profil.php#reserver-creneau"> RESERVER UN CRENEAU </a></li>
                <li><a href="../SPORTIF/profil.php#reservations"> MES RESERVATIONS </a></li>
                <li><a href="../SPORTIF/avis.php#avis"> DEPOSER UN AVIS </a></li>
                <li><a href="#historique"> HISTORIQUE </a></li>
                <li><a href="../messagerie/messagerieSportif.php">MESSAGERIE</a></li>
                <form method="post" action="../SPORTIF/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">
            <section id="historique">
                <div class="encadrer encadrer-modification">
                    <h2>HISTORIQUE DES RESERVATIONS</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure de début</th>
                                <th>Heure de fin</th>
                                <th>Lieu</th>
                                <th>Sport</th>
                                <th>Coach</th>
                                <th>Note</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result_historique->num_rows > 0) {
                                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'français');
                                
                                while ($historique = $result_historique->fetch_assoc()) {
                                    $sql_lieu = "SELECT nom FROM lieu WHERE id_lieu = ?";
                                    $stmt_lieu = $conn->prepare($sql_lieu);
                                    $stmt_lieu->bind_param("i", $historique['id_lieu']);
                                    $stmt_lieu->execute();
                                    $result_lieu = $stmt_lieu->get_result();
                                    $lieu = $result_lieu->fetch_assoc();

                                    $sql_sport = "SELECT nom FROM sport WHERE id_sport = ?";
                                    $stmt_sport = $conn->prepare($sql_sport);
                                    $stmt_sport->bind_param("i", $historique['id_sport']);
                                    $stmt_sport->execute();
                                    $result_sport = $stmt_sport->get_result();
                                    $sport = $result_sport->fetch_assoc();

                                    $sql_coach = "SELECT nom, prenom FROM coach WHERE id_coach = ?";
                                    $stmt_coach = $conn->prepare($sql_coach);
                                    $stmt_coach->bind_param("i", $historique['id_coach']);
                                    $stmt_coach->execute();
                                    $result_coach = $stmt_coach->get_result();
                                    $coach = $result_coach->fetch_assoc();

                                    $formatted_date = strftime("%A %d %B %Y", strtotime($historique['date']));
                                    $formatted_heure_debut = date("H:i", strtotime($historique['heure_debut']));
                                    $formatted_heure_fin = date("H:i", strtotime($historique['heure_fin']));

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_debut) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_fin) . "</td>";
                                    echo "<td>" . htmlspecialchars($lieu['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sport['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($coach['nom']) . " " . htmlspecialchars($coach['prenom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($historique['note']) . "/5</td>";
                                    echo "<td>" . htmlspecialchars($historique['commentaire']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>Aucune réservation avec avis.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</body>
</html>