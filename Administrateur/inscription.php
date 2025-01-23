<?php
session_start(); 

include('../BDD/connexion.php');

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $identifiant = trim($_POST['identifiant']);
    $mot_de_passe = trim($_POST['mot_de_passe']);

    if (empty($nom)) $erreurs[] = "Le nom est requis.";
    if (empty($prenom)) $erreurs[] = "Le prénom est requis.";
    if (empty($identifiant)) $erreurs[] = "L'identifiant est requis.";
    if (empty($mot_de_passe)) $erreurs[] = "Le mot de passe est requis.";

    if (empty($erreurs)) {
        $stmt = $conn->prepare("SELECT * FROM administrateur WHERE identifiant = ?");
        $stmt->bind_param("s", $identifiant);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $erreurs[] = "Cet identifiant est déjà utilisé.";
        } else {
            $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO administrateur (nom, prenom, identifiant, mot_de_passe) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nom, $prenom, $identifiant, $mot_de_passe_hash);

            if ($stmt->execute()) {
                $id_administrateur = $conn->insert_id;

                $_SESSION['administrateur_id'] = $id_administrateur;

                header('Location: ../Administrateur/administrateur.php');
                exit();
            } else {
                $erreurs[] = "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Inscription </title>
    <link rel="stylesheet" href="../Administrateur/inscription.css">
</head>
<body>
<?php include('../PRESENTATION/haut_de_page.php');?>
    <div class='container'>
        <div class="encadrer">
        </div>

        <?php
        if (!empty($erreurs)) {
            echo "<ul class='errors'>";
            foreach ($erreurs as $erreur) {
                echo "<li>" . htmlspecialchars($erreur) . "</li>";
            }
            echo "</ul>";
        }
        ?>

        <form method="POST">
            <div class="encadrer">
                <h1 align="center">INSCRIPTION</h1>
                <div class="search-container">
                    <input type="text" name="nom" placeholder="NOM" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="prenom" placeholder="PRENOM" required/>
                </div>
                <div class="search-container">
                    <input type="text" name="identifiant" placeholder="IDENTIFIANT" required/>
                </div>
                <div class="search-container">
                    <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE" required/>
                </div>
                <button type="submit">S'INSCRIRE</button>
            </div>
        </form>
    </div>
    <?php include('../PRESENTATION/bas_de_page.php');?>
</body>
</html>
