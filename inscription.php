<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> INSCRIPTION </title>
    <link rel="stylesheet" href="style.css">
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
            <h1> TROUVEZ LE COACH QUI VOUS CONVIENT ! </h1>
        </div>
        <form method="POST" action="inscriptioncoach.php">
            <div class="encadrer">
                <h1 align="center"> INSCRIPTION </h1>

                <div class="search-container">
                    <input type="text" name="nom" placeholder="NOM" required/>
                </div>
            
                <div class="search-container">
                    <input type="text" name="prenom" placeholder="PRENOM"/>
                </div>
                    
                <div class="search-container">
                    <input type="text" name="adresse" placeholder="ADRESSE"/>
                </div>
                
                <div class="search-container">
                    <input type="text" name="numero_de_telephone" placeholder="NUMERO DE TELEPHONE"/>
                </div>
        
                <div class="search-container">
                    <input type="text" name="adresse_mail" placeholder="ADRESSE MAIL"/>
                </div>
                
                <div class="search-container">
                    <input type="text" name="identifiant" placeholder="IDENTIFIANT"/>
                </div>

                <div class="search-container">
                    <input type="password" name="mot_de_passe" placeholder="MOT DE PASSE"/>
                </div>

                <button type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
</body>
</html>