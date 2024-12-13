<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> INSCRIPTION </title>
    <link rel="stylesheet" href="inscription.css">

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
            <button> <a href="accueil.html"> ACCUEIL </a> </button>
        </div>
    </div>
    <p> </p>
    <div class='containerinscription'>
        <div class="encadrer">
        <h1> BOOSTEZ VOTRE CARRIÈRE DE COACH ! </h1>
        <p>Vous êtes un coach dynamique, prêt à partager votre expertise et à aider des personnes à atteindre leurs objectifs ? <strong>Coachus</strong> vous offre une plateforme simple et dédiée pour faire évoluer votre métier.</p>
        <p>En vous inscrivant, vous bénéficierez de nombreux avantages :</p>
        <ul>
            <li><strong>Développez votre réseau</strong> : Connectez-vous avec des clients motivés et élargissez votre cercle professionnel.</li>
            <li><strong>Gérez facilement vos créneaux</strong> : Planifiez vos séances, suivez vos progrès et organisez vos rendez-vous en toute simplicité.</li>
            <li><strong>Gagnez en visibilité</strong> : Mettez en avant vos compétences et spécialités pour attirer de nouveaux clients et diversifier votre activité.</li>
        </ul>

        <p>Rejoignez-nous dès aujourd'hui et faites grandir votre activité de coach !</p>

        </div>
        <form method="POST" action="requete_inscription.php">
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

                <button type="submit"> S'INSCRIRE </button>
            </div>
        </form>
    </div>
</body>
</html>