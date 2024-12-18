<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> INSCRIPTION </title>
    <link rel="stylesheet" href="../Inscription/inscription.css">

</head>

<?php

include('modeles/connexion.php'); 

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $adresse = trim($_POST['adresse']);
    $numero_de_telephone = trim($_POST['numero_de_telephone']);
    $adresse_mail = trim($_POST['adresse_mail']);
    $identifiant = trim($_POST['identifiant']);
    $mot_de_passe = trim($_POST['mot_de_passe']);
    
    if (empty($nom)) {
        $erreurs[] = "Le nom est requis.";
    }
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est requis.";
    }
    if (empty($adresse)) {
        $erreurs[] = "L'adresse est requise.";
    }
    if (empty($numero_de_telephone)) {
        $erreurs[] = "Le numéro de téléphone est requis.";
    }
    if (empty($adresse_mail)) {
        $erreurs[] = "L'adresse mail est requise.";
    }
    if (empty($identifiant)) {
        $erreurs[] = "L'identifiant est requis.";
    }
    if (empty($mot_de_passe)) {
        $erreurs[] = "Le mot de passe est requis.";
    }

    if (empty($erreurs)) {
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO coach (nom, prenom, adresse, numero_de_telephone, adresse_mail, identifiant, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssss", $nom, $prenom, $adresse, $numero_de_telephone, $adresse_mail, $identifiant, $mot_de_passe_hash);

        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<body>
    <div class="logo"></div>
      <div class="header-container">
          <div align="left">
              <img src="../LOGO/LOGO.png" alt="logo" width="50" height="75" />
              <a href="../Accueil/Accueil.html">
                  <img class="logo" src="../LOGO/CoachUs.png" alt="logo" width="250" height="75" />
              </a>
          </div>
          <div align="right" class="button-container">
              <button> <a href="../FAQ/FAQ.html"> ?</a>  </button>
              <button> <a href="../Connexion/connexionsportif.php"> JE VEUX UN COACH </a> </button>
              <button> <a href="../Connexion/connexioncoach.php"> JE SUIS COACH  </a></button>
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
        <form method="POST" action="../Inscription/requete_inscriptioncoach.php">
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
