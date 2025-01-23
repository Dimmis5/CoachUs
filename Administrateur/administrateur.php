<?php
session_start();
if (!isset($_SESSION['administrateur_id'])) {
    header('Location: ../Administrateur/connexion.php');
    exit();
}
include('../BDD/connexion.php');

$nombre_coachs = 0;
$nombre_sportifs = 0;

$query_coachs = "SELECT COUNT(*) AS total_coachs FROM coach";
$result_coachs = $conn->query($query_coachs);
if ($result_coachs && $result_coachs->num_rows > 0) {
    $row = $result_coachs->fetch_assoc();
    $nombre_coachs = $row['total_coachs'];
}

$query_sportifs = "SELECT COUNT(*) AS total_sportifs FROM sportif";
$result_sportifs = $conn->query($query_sportifs);
if ($result_sportifs && $result_sportifs->num_rows > 0) {
    $row = $result_sportifs->fetch_assoc();
    $nombre_sportifs = $row['total_sportifs'];
}

$query_lieu = "SELECT COUNT(*) AS total_lieu FROM sportif";
$result_lieu = $conn->query($query_lieu);
if ($result_lieu && $result_lieu->num_rows > 0) {
    $row = $result_lieu->fetch_assoc();
    $nombre_lieu = $row['total_lieu'];
}

$query_faq = "SELECT COUNT(*) AS total_question FROM faq_pending";
$result_faq = $conn->query($query_faq);
if ($result_faq && $result_faq->num_rows > 0) {
    $row = $result_faq->fetch_assoc();
    $nombre_faq = $row['total_question'];
}

$query_icoach = "SELECT COUNT(*) AS total_icoach FROM inscriptions_coach_en_attente";
$result_icoach = $conn->query($query_icoach);
if ($result_icoach && $result_icoach->num_rows > 0) {
    $row = $result_icoach->fetch_assoc();
    $nombre_icoach = $row['total_icoach'];
}

$query_isportif = "SELECT COUNT(*) AS total_isportif FROM inscriptions_en_attente";
$result_isportif = $conn->query($query_isportif);
if ($result_isportif && $result_isportif->num_rows > 0) {
    $row = $result_isportif->fetch_assoc();
    $nombre_isportif = $row['total_isportif'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Administrateur </title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include('../PRESENTATION/haut_de_page.php');?>
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
            <section id="tableaudebord">
                <div class="encadrer encadrer-modification">
                    <h2>TABLEAU DE BORD</h2>
                    <ul>
                        <div class="aligner">
                            <li>Nombre de coachs : <?= htmlspecialchars($nombre_coachs) ?> </li>
                            <button_admin><a href="../Administrateur/coach.php"> GÉRER LES COACHS </a></button>
                        </div>
                        <div class="aligner">
                            <li>Nombre de sportifs : <?= htmlspecialchars($nombre_sportifs) ?></li>
                            <button_admin><a href="../Administrateur/sportif.php"> GÉRER LES SPORTIFS </a></button>
                        </div>
                        <div class="aligner">
                            <li>Nombre de lieux : <?= htmlspecialchars($nombre_lieu) ?></li>
                            <button_admin><a href="../Administrateur/lieu.php"> GÉRER LES LIEUX </a></button>
                        </div>
                        <div class="aligner">
                            <li>Nombre de questions en attente : <?= htmlspecialchars($nombre_faq) ?></li>
                            <button_admin><a href="../Administrateur/gestion_FAQ.php"> GÉRER LES QUESTIONS </a></button>
                        </div>
                        <div class="aligner">
                            <li>Nombre de coachs en attente d'inscription : <?= htmlspecialchars($nombre_icoach) ?></li>
                            <button_admin><a href="../Administrateur/inscription_coach/coach_attente.php"> GÉRER LES INSCRIPTIONS COACH </a></button>
                        </div>
                        <div class="aligner">
                            <li>Nombre de sportifs en attente d'inscription : <?= htmlspecialchars($nombre_isportif) ?></li>
                            <button_admin><a href="../Administrateur/inscription_sportif/sportif_attente.php"> GÉRER LES INSCRIPTIONS SPORTIF </a></button>
                        </div>
                    </ul>
                </div>
            </section>
        </div>
    </div>
    <?php include('../PRESENTATION/bas_de_page.php');?>
</body>
</html>
