<?php
session_start();
if (!isset($_SESSION['sportif_id'])) {
    header('Location: ../SPORTIF/connexion.php');
    exit();
}

include('../BDD/connexion.php');
include('../REQUETES_SPORTIF/deposeravis.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sportif</title>
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
                <li><a href="#avis"> DEPOSER UN AVIS </a></li>
                <li><a href="../SPORTIF/historique.php#historique"> HISTORIQUE </a></li>
                <li><a href="../messagerie/messagerieSportif.php">MESSAGERIE</a></li>
                <form method="post" action="../SPORTIF/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">
            <section id="avis">
                <div class="encadrer encadrer-modification">
                    <h2> DEPOSER UN AVIS </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure de début</th>
                                <th>Heure de fin</th>
                                <th>Lieu</th>
                                <th>Sport</th>
                                <th>Coach</th>
                                <th>Avis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result_passees->num_rows > 0) {
                                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'français');
                                
                                while ($passees = $result_passees->fetch_assoc()) {
                                    $sql_lieu = "SELECT nom FROM lieu WHERE id_lieu = ?";
                                    $stmt_lieu = $conn->prepare($sql_lieu);
                                    $stmt_lieu->bind_param("i", $passees['id_lieu']);
                                    $stmt_lieu->execute();
                                    $result_lieu = $stmt_lieu->get_result();
                                    $lieu = $result_lieu->fetch_assoc();

                                    $sql_sport = "SELECT nom FROM sport WHERE id_sport = ?";
                                    $stmt_sport = $conn->prepare($sql_sport);
                                    $stmt_sport->bind_param("i", $passees['id_sport']);
                                    $stmt_sport->execute();
                                    $result_sport = $stmt_sport->get_result();
                                    $sport = $result_sport->fetch_assoc();

                                    $sql_coach = "SELECT nom, prenom FROM coach WHERE id_coach = ?";
                                    $stmt_coach = $conn->prepare($sql_coach);
                                    $stmt_coach->bind_param("i", $passees['id_coach']);
                                    $stmt_coach->execute();
                                    $result_coach = $stmt_coach->get_result();
                                    $coach = $result_coach->fetch_assoc();

                                    $formatted_date = strftime("%A %d %B %Y", strtotime($passees['date']));
                                    $formatted_heure_debut = date("H:i", strtotime($passees['heure_debut']));
                                    $formatted_heure_fin = date("H:i", strtotime($passees['heure_fin']));

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_debut) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_fin) . "</td>";
                                    echo "<td>" . htmlspecialchars($lieu['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sport['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($coach['nom']) . " " . htmlspecialchars($coach['prenom']) . "</td>";

                                    if ($passees['note'] == 0) {
                                        echo "<td>
                                                <form action='../REQUETES_SPORTIF/avis.php' method='POST'>
                                                    <input type='hidden' name='id_reservation' value='" . $passees['id_reservation'] . "'>
                                                    <input type='hidden' name='id_sportif' value='" . $_SESSION['sportif_id'] . "'>
                                                    <label for='note'>Note (sur 5) :</label>
                                                    <input type='number' name='note' min='1' max='5' required><br>
                                                    <label for='commentaire'>Commentaire :</label><br>
                                                    <textarea name='commentaire' rows='4' cols='50'></textarea><br>
                                                    <button type='submit'>Déposer l'avis</button>
                                                </form>
                                            </td>";
                                    } else {
                                        echo "<td>Note: " . htmlspecialchars($passees['note']) . "/5<br>Commentaire: " . nl2br(htmlspecialchars($passees['commentaire'])) . "</td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Aucune réservation passée.</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="../REQUETES_SPORTIF/creneau1.js"></script>

</body>
</html>
