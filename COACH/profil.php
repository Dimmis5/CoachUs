<?php
session_start();
if (!isset($_SESSION['coach_id'])) {
    header('Location: ../COACH/connexion.php');
    exit();
}

include('../BDD/connexion.php');
include('../REQUETES_COACH/informations.php');
include('../REQUETES_COACH/modifier_informations.php');
include('../REQUETES_COACH/creneau.php');
include('../REQUETES_COACH/disponibilites.php');
include('../REQUETES_COACH/reservation.php');
include('../REQUETES_COACH/lieux.php');
include('../REQUETES_COACH/sports.php');
include('../REQUETES_COACH/avis.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Coach</title>
    <link rel="stylesheet" href="../style2.css">
</head>

<body>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="#modifier-infos">MODIFIER MES INFORMATIONS</a></li>
                <li><a href="#renseigner-disponibilites">RENSEIGNER MES DISPONIBILITES</a></li>
                <li><a href="#mes-disponibilites">MES DISPONIBILITES</a></li>
                <li><a href="#sports-enseignes">MES SPORTS</a></li>
                <li><a href="#lieux-choisis">MES LIEUX</a></li>
                <li><a href="#creneaux-reserves"> RESERVATIONS </a></li>
                <li><a href="#avis"> AVIS </a></li>
                <form method="post" action="../COACH/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">
            <h1>BIENVENUE <?php echo htmlspecialchars($coach['prenom']); ?> <?php echo htmlspecialchars($coach['nom']); ?> ! </h1>
            <section id="modifier-infos">

                <div class="encadrer encadrer-modification">
                    <h2>MODIFIER MES INFORMATIONS</h2>
                    <?php
                    if (!empty($erreurs)) {
                        echo "<ul class='errors'>";
                        foreach ($erreurs as $erreur) {
                            echo "<li>" . htmlspecialchars($erreur) . "</li>";
                        }
                        echo "</ul>";
                    }
                    ?>

                    <form method="post" action="">
                        <label for="nom">NOM :</label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($coach['nom']); ?>" required>

                        <label for="prenom">PRENOM :</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($coach['prenom']); ?>" required>

                        <label for="adresse">ADRESSE :</label>
                        <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($coach['adresse']); ?>" required>

                        <label for="numero_de_telephone">NUMERO DE TELEPHONE :</label>
                        <input type="text" id="numero_de_telephone" name="numero_de_telephone" value="<?php echo htmlspecialchars($coach['numero_de_telephone']); ?>" required>

                        <label for="adresse_mail">ADRESSE MAIL :</label>
                        <input type="email" id="adresse_mail" name="adresse_mail" value="<?php echo htmlspecialchars($coach['adresse_mail']); ?>" required>

                        <button type="submit" name="update_info">METTRE A JOUR MES INFORMATIONS</button>
                    </form>
                </div>
            </section>

            <section id="renseigner-disponibilites">
                <div class="encadrer encadrer-modification">
                    <h2>RENSEIGNER MES DISPONIBILITES</h2>
                    <?php
                    if (!empty($erreurs)) {
                        echo "<ul class='errors'>";
                        foreach ($erreurs as $erreur) {
                            echo "<li>" . htmlspecialchars($erreur) . "</li>";
                        }
                        echo "</ul>";
                    }
                    ?>

                    <form method="post" action="">
                        <label for="date">Date :</label>
                        <input type="date" id="date" name="date" required>

                        <label for="heure_debut">Heure de début :</label>
                        <input type="time" id="heure_debut" name="heure_debut" required>

                        <label for="heure_fin">Heure de fin :</label>
                        <input type="time" id="heure_fin" name="heure_fin" required>

                        <label for="id_lieu">Sélectionnez un lieu :</label>
                        <select name="id_lieu" id="id_lieu">
                            <option value="" disabled selected>Sélectionnez un lieu</option>
                            <?php
                            $sql = "SELECT id_lieu, nom FROM lieu";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id_lieu'] . '">' . htmlspecialchars($row['nom']) . '</option>';
                                }
                            }
                            ?>
                        </select>

                        <label for="id_sport">Sélectionnez un sport :</label>
                        <select name="id_sport" id="id_sport">
                            <option value="" disabled selected>Sélectionnez un sport</option>
                            <?php
                            $sql = "SELECT id_sport, nom FROM sport";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id_sport'] . '">' . htmlspecialchars($row['nom']) . '</option>';
                                }
                            }
                            ?>
                        </select>

                        <button type="submit">AJOUTER LE CRENEAU</button>
                    </form>
                </div>
            </section>

            <section id="mes-disponibilites">
                <div class="encadrer encadrer-modification">
                    <h2>MES DISPONIBILITES</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure de début</th>
                                <th>Heure de fin</th>
                                <th>Lieu</th>
                                <th>Sport</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result_dispos->num_rows > 0) {
                                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'français');
                                
                                while ($dispo = $result_dispos->fetch_assoc()) {
                                    $sql_lieu = "SELECT nom FROM lieu WHERE id_lieu = ?";
                                    $stmt_lieu = $conn->prepare($sql_lieu);
                                    $stmt_lieu->bind_param("i", $dispo['id_lieu']);
                                    $stmt_lieu->execute();
                                    $result_lieu = $stmt_lieu->get_result();
                                    $lieu = $result_lieu->fetch_assoc();

                                    $sql_sport = "SELECT nom FROM sport WHERE id_sport = ?";
                                    $stmt_sport = $conn->prepare($sql_sport);
                                    $stmt_sport->bind_param("i", $dispo['id_sport']);
                                    $stmt_sport->execute();
                                    $result_sport = $stmt_sport->get_result();
                                    $sport = $result_sport->fetch_assoc();

                                    $formatted_date = strftime("%A %d %B %Y", strtotime($dispo['date']));

                                    $formatted_heure_debut = date("H:i", strtotime($dispo['heure_debut']));
                                    $formatted_heure_fin = date("H:i", strtotime($dispo['heure_fin']));

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_debut) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_fin) . "</td>";
                                    echo "<td>" . htmlspecialchars($lieu['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sport['nom']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Aucun créneau de disponibilité.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section id="sports-enseignes">
                <div class="encadrer encadrer-modification">
                    <h2> MES SPORTS </h2>
                    <ul>
                        <?php
                        if ($result_sports->num_rows > 0) {
                            while ($row = $result_sports->fetch_assoc()) {
                                echo "<li>" . htmlspecialchars($row['nom']) . "</li>";
                            }
                        } else {
                            echo "<li>Aucun sport enseigné.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </section>

            <section id="lieux-choisis">
                <div class="encadrer encadrer-modification">
                    <h2> MES LIEUX </h2>
                    <ul>
                        <?php
                        if ($result_lieux->num_rows > 0) {
                            while ($row = $result_lieux->fetch_assoc()) {
                                echo "<li>" . htmlspecialchars($row['nom']) . "</li>";
                            }
                        } else {
                            echo "<li>Aucun lieu sélectionné.</li>";
                        }
                        ?>
                        <button><a href="../CARTE/Carte.html"> VOIR SUR LA CARTE </a></button>
                    </ul>
            </section>

            <section id="reservations">
                <div class="encadrer encadrer-modification">
                    <h2> MES RESERVATIONS </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure de début</th>
                                <th>Heure de fin</th>
                                <th>Lieu</th>
                                <th>Sport</th>
                                <th>Coach</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result_dispos->num_rows > 0) {
                                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'français');
                                
                                while ($dispo = $result_dispos->fetch_assoc()) {
                                    $sql_lieu = "SELECT nom FROM lieu WHERE id_lieu = ?";
                                    $stmt_lieu = $conn->prepare($sql_lieu);
                                    $stmt_lieu->bind_param("i", $dispo['id_lieu']);
                                    $stmt_lieu->execute();
                                    $result_lieu = $stmt_lieu->get_result();
                                    $lieu = $result_lieu->fetch_assoc();

                                    $sql_sport = "SELECT nom FROM sport WHERE id_sport = ?";
                                    $stmt_sport = $conn->prepare($sql_sport);
                                    $stmt_sport->bind_param("i", $dispo['id_sport']);
                                    $stmt_sport->execute();
                                    $result_sport = $stmt_sport->get_result();
                                    $sport = $result_sport->fetch_assoc();

                                    $sql_sportif = "SELECT nom, prenom FROM sportif WHERE id_sportif = ?";
                                    $stmt_sportif = $conn->prepare($sql_sportif);
                                    $stmt_sportif->bind_param("i", $dispo['id_sportif']);
                                    $stmt_sportif->execute();
                                    $result_sportif = $stmt_sportif->get_result();
                                    $sportif = $result_sportif->fetch_assoc();

                                    $formatted_date = strftime("%A %d %B %Y", strtotime($dispo['date']));

                                    $formatted_heure_debut = date("H:i", strtotime($dispo['heure_debut']));
                                    $formatted_heure_fin = date("H:i", strtotime($dispo['heure_fin']));

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_debut) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_fin) . "</td>";
                                    echo "<td>" . htmlspecialchars($lieu['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sport['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sportif['nom']) . " " . htmlspecialchars($sportif['prenom']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Aucune disponibilité.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

                   
            <section id="avis">
                <div class="encadrer encadrer-modification">
                    <h2> AVIS </h2>
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
                            if ($result_avis->num_rows > 0) {
                                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'français');
                                
                                while ($avis = $result_avis->fetch_assoc()) {
                                    $sql_lieu = "SELECT nom FROM lieu WHERE id_lieu = ?";
                                    $stmt_lieu = $conn->prepare($sql_lieu);
                                    $stmt_lieu->bind_param("i", $avis['id_lieu']);
                                    $stmt_lieu->execute();
                                    $result_lieu = $stmt_lieu->get_result();
                                    $lieu = $result_lieu->fetch_assoc();

                                    $sql_sport = "SELECT nom FROM sport WHERE id_sport = ?";
                                    $stmt_sport = $conn->prepare($sql_sport);
                                    $stmt_sport->bind_param("i", $avis['id_sport']);
                                    $stmt_sport->execute();
                                    $result_sport = $stmt_sport->get_result();
                                    $sport = $result_sport->fetch_assoc();

                                    $sql_sportif = "SELECT nom, prenom FROM sportif WHERE id_sportif = ?";
                                    $stmt_sportif = $conn->prepare($sql_sportif);
                                    $stmt_sportif->bind_param("i", $avis['id_sportif']);
                                    $stmt_sportif->execute();
                                    $result_sportif = $stmt_sportif->get_result();
                                    $sportif = $result_sportif->fetch_assoc();

                                    $formatted_date = strftime("%A %d %B %Y", strtotime($avis['date']));
                                    $formatted_heure_debut = date("H:i", strtotime($avis['heure_debut']));
                                    $formatted_heure_fin = date("H:i", strtotime($avis['heure_fin']));

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_debut) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_fin) . "</td>";
                                    echo "<td>" . htmlspecialchars($lieu['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sport['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sportif['nom']) . " " . htmlspecialchars($sportif['prenom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($avis['note']) . "/5</td>";
                                    echo "<td>" . htmlspecialchars($avis['commentaire']) . "</td>";
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
