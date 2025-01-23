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
            $_SESSION['error_message'] = "Mot de passe incorrect.";
            header('Location: ../Administrateur/connexion.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Identifiant incorrect.";
        header('Location: ../Administrateur/connexion.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Connexion du sportif</title>
    <link rel="stylesheet" href="../Administrateur/connexion.css">
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class='container'>
        <form method="POST">
            <div class="encadrer">
                <h1 align="center">CONNEXION</h1>
                <div class="search-container">
                    <input type="text" name="identifiant" placeholder="IDENTIFIANT" value="<?php echo htmlspecialchars($identifiant ?? ''); ?>"/>
                </div>
                <div class="search-container">
                    <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                </div><br>
                <p></p>
                <button type="submit">CONNEXION</button>
                <div class="rectangle">
                    <div class="cercle"> 
                        <span>OU</span>
                    </div>
                </div>
                <button><a href="../Administrateur/inscription.php">INSCRIPTION</a></button>
                <p></p>
            </div>
        </form>
    </div>

    <?php
    if (!empty($_SESSION['error_message'])) {
        echo "<script>showAlert('" . htmlspecialchars($_SESSION['error_message']) . "');</script>";
        unset($_SESSION['error_message']);
    }
    ?>
</body>
</html>
