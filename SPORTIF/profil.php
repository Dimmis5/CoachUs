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
include('../REQUETES_SPORTIF/mesreservations.php');
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
    <div class="header-container">
            <div align="left">
                <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
                <img src="../LOGO/CoachUS.png" class="logo" alt="logo" width="250" height="70" />
            </div>
            <div align="right" class="button-container">
                <button> <a href="../FAQ/FAQ.php"> ?</a>  </button>
                <button> <a href="../SPORTIF/profil.php">JE VEUX UN COACH </a> </button>
                <button> <a href="../COACH/profil.php">JE SUIS COACH  </a></button>
            </div>
        </div>
    <div class="container">
        <div class="menu-gauche">
            <h2>MENU</h2>
            <ul>
                <li><a href="#modifier-infos">MODIFIER MES INFORMATIONS</a></li>
                <li><a href="#reserver-creneau"> RESERVER UN CRENEAU </a></li>
                <li><a href="#reservations"> MES RESERVATIONS </a></li>
                <li><a href="../SPORTIF/avis.php"> DEPOSER UN AVIS </a></li>
                <li><a href="../messagerie/messagerieSportif.php">MESSAGERIE</a></li>
                <form method="post" action="../SPORTIF/deconnexion.php">
                    <button type="submit" name="logout"> SE DECONNECTER </button>
                </form>
            </ul>
        </div>

        <div class="contenu-principal">
            <h1>BIENVENUE <?php echo htmlspecialchars($sportif['prenom']); ?> <?php echo htmlspecialchars($sportif['nom']); ?> ! </h1>
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
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($sportif['nom']); ?>" required>

                        <label for="prenom">PRENOM :</label>
                        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($sportif['prenom']); ?>" required>

                        <label for="adresse">ADRESSE :</label>
                        <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($sportif['adresse']); ?>" required>

                        <label for="numero_de_telephone">NUMERO DE TELEPHONE :</label>
                        <input type="text" id="numero_de_telephone" name="numero_de_telephone" value="<?php echo htmlspecialchars($sportif['numero_de_telephone']); ?>" required>

                        <label for="adresse_mail">ADRESSE MAIL :</label>
                        <input type="email" id="adresse_mail" name="adresse_mail" value="<?php echo htmlspecialchars($sportif['adresse_mail']); ?>" required>

                        <button type="submit" name="update_info">METTRE A JOUR MES INFORMATIONS</button>
                    </form>
                </div>
            </section>

            <section id="reserver-creneau">
                <div class="encadrer encadrer-modification">
                    <h2>RESERVER UN CRENEAU</h2>
                    <form method="POST" action="#reserver-creneau">
                        <label for="id_sport">SPORT :</label>
                        <select name="id_sport" id="id_sport" onchange="this.form.submit()">
                            <option value="" disabled <?= empty($id_sport) ? 'selected' : '' ?>>Sélectionnez un sport</option>
                            <?php foreach ($sports as $sport): ?>
                                <option value="<?= $sport['id_sport'] ?>" <?= $id_sport == $sport['id_sport'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($sport['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="id_coach">COACH :</label>
                        <select name="id_coach" id="id_coach" onchange="this.form.submit()">
                            <option value="" disabled <?= empty($id_coach) ? 'selected' : '' ?>>Sélectionnez un coach</option>
                            <?php foreach ($coaches as $coach): ?>
                                <option value="<?= $coach['id_coach'] ?>" <?= $id_coach == $coach['id_coach'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($coach['nom']) . ' ' . htmlspecialchars($coach['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="id_lieu">LIEU :</label>
                        <select name="id_lieu" id="id_lieu" onchange="this.form.submit()">
                            <option value="" disabled <?= empty($id_lieu) ? 'selected' : '' ?>>Sélectionnez un lieu</option>
                            <?php foreach ($lieux as $lieu): ?>
                                <option value="<?= $lieu['id_lieu'] ?>" <?= $id_lieu == $lieu['id_lieu'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($lieu['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="RECHERCHER">
                    </form>

                    <?php foreach ($disponibilitesParJour as $jour => $heures): ?>
                        <div class="jour-disponibilites">
                            <h3><?= ucfirst($jour) ?></h3>
                            <div class="heures">
                                <?php foreach ($heures as $disponibilite): ?>
                                    <button 
                                        data-id="<?= $disponibilite['id_disponibilite'] ?>"
                                        data-date="<?= $disponibilite['date'] ?>"
                                        data-heuredebut="<?= $disponibilite['heure_debut'] ?>"
                                        data-heurefin="<?= $disponibilite['heure_fin'] ?>"
                                        data-coachnom="<?= $disponibilite['nom_coach'] ?>"
                                        data-coachprenom="<?= $disponibilite['prenom_coach'] ?>"
                                        data-idcoach="<?= $disponibilite['id_coach'] ?>"
                                        data-lieu="<?= $disponibilite['nom_lieu'] ?>"
                                        data-idlieu="<?= $disponibilite['id_lieu'] ?>"
                                        data-sport="<?= $disponibilite['nom_sport'] ?>"
                                        data-idsport="<?= $disponibilite['id_sport'] ?>"
                                        data-idsportif="<?= $_SESSION['sportif_id'] ?>"
                                        class="btn-disponibilite <?= $disponibilite['reserved'] ? 'grisé' : '' ?>"
                                        <?= $disponibilite['reserved'] ? 'disabled' : '' ?>
                                            onclick="<?= $disponibilite['reserved'] ? '' : 'details(this)' ?>">
                                        <?= $disponibilite['heure_debut'] ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>  
                </div>
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

                                    $sql_coach = "SELECT nom, prenom FROM coach WHERE id_coach = ?";
                                    $stmt_coach = $conn->prepare($sql_coach);
                                    $stmt_coach->bind_param("i", $dispo['id_coach']);
                                    $stmt_coach->execute();
                                    $result_coach = $stmt_coach->get_result();
                                    $coach = $result_coach->fetch_assoc();

                                    $formatted_date = strftime("%A %d %B %Y", strtotime($dispo['date']));

                                    $formatted_heure_debut = date("H:i", strtotime($dispo['heure_debut']));
                                    $formatted_heure_fin = date("H:i", strtotime($dispo['heure_fin']));

                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($formatted_date) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_debut) . "</td>";
                                    echo "<td>" . htmlspecialchars($formatted_heure_fin) . "</td>";
                                    echo "<td>" . htmlspecialchars($lieu['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($sport['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($coach['nom']) . " " . htmlspecialchars($coach['prenom']) . "</td>";
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
        </div>
    </div>

    <script src="../REQUETES_SPORTIF/creneau1.js"></script>

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
