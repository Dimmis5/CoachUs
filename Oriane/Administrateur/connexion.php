<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../BDD/connexion.php');

    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = "SELECT id_administrateur, mot_de_passe FROM administrateur WHERE identifiant = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $identifiant);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            $_SESSION['administrateur_id'] = $row['id_administrateur'];
            
            header('Location: ../Administrateur/administrateur.php');
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Connexion de l'administrateur" </title>
    <link rel="stylesheet" href="../Administrateur/connexion.css">
</head>
<body>
    <div class='container'>
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
                <h1 align="center"> CONNEXION </h1>
                <div class="search-container">
                    <input type="text" name="identifiant" placeholder="IDENTIFIANT" value="<?php echo htmlspecialchars($identifiant ?? ''); ?>"/>
                </div>
                <div class="search-container">
                    <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                </div><br>
                <p> </p>
                <button type="submit"> CONNEXION </button>
                <div class="rectangle">
                    <div class="cercle"> 
                        <span> OU </span>
                    </div>
                </div>
                <button><a href="../Administrateur/inscription.php"> INSCRIPTION </a></button>
            </div>
        </form>
    </div>
</body>
</html>
