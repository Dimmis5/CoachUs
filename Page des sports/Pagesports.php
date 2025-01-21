<?php
    // Inclusion du fichier de connexion
    include('../BDD/connexion.php');

    // Récupérer le sport sélectionné
    $sport = isset($_GET['sport']) ? htmlspecialchars($_GET['sport']) : 'Inconnu';

    // Tableau des ID d'images associées à chaque sport
    $sportImages = [
        'bad' => 2,
        'baseball' => 3,
        'basket' => 10, // Le sport 'basket' a un id_sport = 10
        'cycli' => 5,
        'foot' => 6,
        'golf' => 7,
        'muscu' => 8,
        'ping' => 9
    ];

    // Définir l'ID du sport en fonction de la sélection
    $sportId = isset($sportImages[$sport]) ? $sportImages[$sport] : null;

    // Vérifier si l'ID du sport est valide
    if ($sportId === null) {
        echo "Sport inconnu.";
        exit; // Arrêter l'exécution du script si le sport est invalide
    }

    // Récupérer les coachs associés à ce sport
    try {
        $sql = "SELECT c.id_coach, c.prenom, c.nom, c.chemin_image FROM coach c 
                JOIN sport s ON c.id_sport = s.id_sport
                WHERE s.id_sport = :sportId";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':sportId', $sportId, PDO::PARAM_INT); // Utilisation de l'ID du sport
        $stmt->execute();
        $coachs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Debugging
        echo 'Sport sélectionné : ' . htmlspecialchars($sport) . '<br>';
        echo 'Nombre de coachs trouvés : ' . count($coachs) . '<br>';
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
        $coachs = [];
    }
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des coachs - <?php echo htmlspecialchars($sport); ?></title>
        <link rel="stylesheet" href="../Page des sports/pagesdessports.css">
    </head>
    <body>
        <div class="container">
            <div class="menu-gauche">
                <h2><?php echo htmlspecialchars($sport); ?></h2>
            </div>

            <div class="contenu-principal">
                <h1 align="center">Liste des coachs de <?php echo htmlspecialchars($sport); ?></h1>
                
                <!-- Afficher l'image du sport -->
                <?php if ($sportId): ?>
                    <div class="image-sport">
                        <img src="../Images/<?php echo $sportId; ?>.jpg" alt="Image du sport <?php echo htmlspecialchars($sport); ?>" width="400" height="300">
                    </div>
                <?php endif; ?>

                <!-- Afficher les coachs -->
                <div class="liste-coachs">
                    <?php if (!empty($coachs)): ?>
                        <?php foreach ($coachs as $coach): ?>
                            <div class="coach">
                                <a href="../Profilducoach/Profilcoach.php?id=<?php echo $coach['id_coach']; ?>">
                                    <img src="<?php echo htmlspecialchars("../" . $coach['chemin_image']); ?>" 
                                        alt="Image de <?php echo htmlspecialchars($coach['prenom'] . ' ' . $coach['nom']); ?>" 
                                        width="200" height="300">
                                </a>
                                <p><?php echo htmlspecialchars($coach['prenom'] . ' ' . $coach['nom']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun coach trouvé pour ce sport.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
    </html>
