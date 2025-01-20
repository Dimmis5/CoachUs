<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title> Connexion du sportif </title>
    <link rel="stylesheet" href="../SPORTIF/connexion.css">
</head>
<body>
    <div class='container'>
        <div class="encadrer">
            <h1> PARTAGEZ VOTRE EXPERTISE, VIVEZ DE VOTRE PASSION ! </h1>
            <p> Créez votre propre emploi du temps et enseignez à votre rythme </p>
            <p> Coachez en ligne ou en personne, où que vous soyez </p>
            <p> Fixez vos tarifs librement - valorisez votre savoir-faire (entre 20 et 80€ de l'heure) </p>
            <p> </p>
            <p> Vous êtes étudiant, professionnel, passionné ou diplômé ? Inscrivez-vous dès maintenant et commencez à coacher sur notre plateforme ! </p>
            <p> </p>
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

        <form method="POST" action="../REQUETES_SPORTIF/connexion.php">
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
                <button><a href="../SPORTIF/inscription.php"> INSCRIPTION </a></button>
                <p> </p>
            </div>
        </form>
    </div>
</body>
</html>
