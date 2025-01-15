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
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include('../PRESENTATION/haut_de_page.php') ?>
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
                <li><a href="../messagerie/messagerieCoach.php">MESSAGERIE</a></li>

                <form method="post" action="../COACH/deconnexion.php">
                    <button type="submit" name="logout">
                         SE DECONNECTER </button>
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

            <section id="creneaux-reserves">
                <div class="encadrer encadrer-modification">
                    <h2> RESERVATIONS </h2>
                    <ul>
                        <?php
                        if ($result_reservations->num_rows > 0) {
                            while ($row = $result_reservations->fetch_assoc()) {
                                echo "<li>Réservation: " . htmlspecialchars($row['date']) . " " . htmlspecialchars($row['heure_debut']) . " - " . htmlspecialchars($row['heure_fin']) . "</li>";
                            }
                        } else {
                            echo "<li>Aucune réservation.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </section>

            <section id="avis">
                <div class="encadrer encadrer-modification">
                    <h2> AVIS </h2>
                    <ul>
                        <?php
                        if ($result_avis->num_rows > 0) {
                            while ($row = $ravis->fetch_assoc()) {
                                echo "<li>Avis: " . htmlspecialchars($row['note']) . " " . htmlspecialchars($row['commentaire']) . "  </li>";
                            }
                        } else {
                            echo "<li>Aucun avis.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </section>
        </div>

        <div class="menu-droit">
            <h1> NOUVEAUTES </h1>
            <section id="derniers creneaux">
                <div class="encadrer encadrer-modification">
                    <h2> DERNIERES RESERVATIONS </h2>
                    <ul>
                        <?php
                        $current_week_start = date('Y-m-d', strtotime('monday this week'));
                        $current_week_end = date('Y-m-d', strtotime('sunday this week'));

                        $sql_reservations_week = "
                            SELECT d.date, d.heure_debut, d.heure_fin, d.id_lieu, d.id_sport, r.id_reservation 
                            FROM disponibilite d 
                            INNER JOIN reservation r 
                            ON d.id_disponibilite = r.id_disponibilite
                            WHERE d.id_coach = ? AND d.date BETWEEN ? AND ?
                            ORDER BY d.date, d.heure_debut";

                        $stmt_reservations_week = $conn->prepare($sql_reservations_week);
                        $stmt_reservations_week->bind_param("iss", $_SESSION['coach_id'], $current_week_start, $current_week_end);
                        $stmt_reservations_week->execute();
                        $result_reservations_week = $stmt_reservations_week->get_result();

                        if ($result_reservations_week->num_rows > 0) {
                            while ($reservation = $result_reservations_week->fetch_assoc()) {
                                $formatted_date = strftime("%A %d %B %Y", strtotime($reservation['date']));
                                $formatted_start = date("H:i", strtotime($reservation['heure_debut']));
                                $formatted_end = date("H:i", strtotime($reservation['heure_fin']));
                                echo "<li>$formatted_date : $formatted_start - $formatted_end</li>";
                            }
                        } else {
                            echo "<li>Aucun créneau réservé cette semaine.</li>";
                        }
                        ?>
                    </ul>
                </div>
            </section>
                    
            <section id="derniers avis">
                <div class="encadrer encadrer-modification">
                    <h2> DERNIERS AVIS </h2>
                    <ul>
                        <?php
                            $query = "SELECT 
                                r.commentaire AS avis, 
                                r.note, 
                                d.date, 
                                d.heure_debut, 
                                d.heure_fin, 
                                c.nom AS coach_nom, 
                                l.nom AS lieu_nom, 
                                s.nom AS sport_nom 
                                FROM 
                                    reservation r
                                INNER JOIN 
                                    disponibilite d ON r.id_disponibilite = d.id_disponibilite
                                INNER JOIN 
                                    coach c ON r.id_coach = c.id_coach
                                INNER JOIN 
                                    lieu l ON d.id_lieu = l.id_lieu
                                INNER JOIN 
                                    sport s ON d.id_sport = s.id_sport
                                WHERE 
                                    r.commentaire IS NOT NULL 
                                ORDER BY 
                                    r.id_reservation DESC 
                                LIMIT 5";

                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<li>";
                                    echo "<strong>{$row['avis']}</strong> - Note : {$row['note']}<br>";
                                    echo "Coach : {$row['coach_nom']}, Lieu : {$row['lieu_nom']}, Sport : {$row['sport_nom']}<br>";
                                    echo "Le : {$row['date']} de {$row['heure_debut']} à {$row['heure_fin']}";
                                    echo "</li>";
                                }
                            } else {
                                echo "<li>Aucun avis publié pour le moment.</li>";
                            }
                        ?>
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <footer>
            <div class="footer-container">
              <div class="footer-column">
                <h3>Nos Services</h3>
                <ul>
                  <li><a href="#"> Service clientèle </a></li>
                  <li><a href="#"> Réglement intérieur </a></li>
                  <li><a href="#"> Heure d'ouverture </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>À propos</h3>
                <ul>
                  <li><a href="#"> Notre Histoire </a></li>
                  <li><a href="../Mentionslégales/MentionsLégales.html"> Mentions Légales </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>Nos Lieux</h3>
                <ul>
                    <li><a href="../Carte/Carte.html"> Aubervilliers </a></li>
                    <li><a href="../Carte/Carte.html"> Boulogne-Billancourt </a></li>
                    <li><a href="../Carte/Carte.html"> Châtillon </a></li>
                    <li><a href="../Carte/Carte.html"> Colombes </a></li>
                    <li><a href="../Carte/Carte.html"> Courbevoie </a></li>
                    <li><a href="../Carte/Carte.html"> Créteil </a></li>
                    <li><a href="../Carte/Carte.html"> Issy-les-Moulineaux </a></li>
                    <li><a href="../Carte/Carte.html"> Massy </a></li>
                    <li><a href="../Carte/Carte.html"> Meudon </a></li>
                    <li><a href="../Carte/Carte.html"> Paris </a></li>
                    <li><a href="../Carte/Carte.html"> Versailles </a></li>
                </ul>
              </div>
              <div class="footer-column">
                <h3>Nous Contacter</h3>
                <ul>
                  <li> support@coachus.com </li>
                  <li><a href="../FAQ/FAQ.html"> FAQ </a></li>
                </ul>
              </div>
            </div>
          
            <div class="footer-bottom">
              <p>&copy; 2024 COACHUS. Tous droits réservés.</p>
            </div>
        </footer>
</body>
</html>
