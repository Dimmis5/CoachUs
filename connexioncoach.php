<!DOCTYPE html>
<html>  
    <head>
        <title> Connexion du coach </title>
        <link rel="stylesheet" href="connexion.css">
    </head>

    <?php
    if (!empty($erreurs)) {
        echo "<ul>";
        foreach ($erreurs as $erreur) {
            echo "<li>" . $erreur . "</li>";
        }
        echo "</ul>";
    }
?>
    <body>
        <div class="header-container">
            <h1 align="left"> COACHUS </h1>
            <div align="right" class="button-container">
                <button> <a href="FAQ.html"> ? </a> </button>
                <button> <a href="connexionsportif.html"> JE VEUX UN COACH </a> </button>
                <button> <a href="connexioncoach.html"> JE SUIS COACH </a> </button>
            </div>
        </div>
        <p> </p>
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
            <form method="POST" action="requete_connexioncoach.php">
                <div class="encadrer">
                    <h1 align="center"> CONNEXION </h1>
                    <div class="search-container">
                        <input type="text" name="identifiant" placeholder="IDENTIFIANT"/>
                    </div>
                    <div class="search-container">
                        <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                    </div><br>
                    <button> CONNEXION </button>
                    <div class="rectangle">
                        <div class="cercle"> 
                            <span> OU </span>
                        </div>
                    </div>
                    <button><a href="inscriptioncoach.php">INSCRIPTION  </a> </button>
                </div>
            </form>
        </div>
    </body>
</html>