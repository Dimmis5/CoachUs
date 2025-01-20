<?php
// Inclure le fichier de connexion à la base de données
include('../BDD/connexion.php');  // Ajuste le chemin si nécessaire

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifie si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Récupère les informations du fichier téléchargé
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];

        // Définir le répertoire où l'image sera stockée
        $uploadDir = __DIR__ . 'C:\xampp\htdocs\CoachUs(htdocs)\Images';  // Utilise __DIR__ pour obtenir un chemin absolu

        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crée le dossier si nécessaire
        }

        $uploadFile = $uploadDir . $imageName;

        // Vérifie que le fichier est une image
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $validExtensions)) {
            // Déplace l'image dans le répertoire de destination
            if (move_uploaded_file($imageTmpName, $uploadFile)) {
                // L'image a été téléchargée avec succès, insérer son chemin dans la base de données
                $sql = "INSERT INTO images (image_path) VALUES (:image_path)";
                $stmt = $connexion->prepare($sql);
                $stmt->bindValue(':image_path', $uploadFile, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo "Image téléchargée et chemin enregistré dans la base de données avec succès.";
                } else {
                    echo "Erreur lors de l'enregistrement du chemin dans la base de données.";
                }
            } else {
                echo "Erreur lors du téléchargement de l'image. Vérifiez les permissions du dossier.";
            }
        } else {
            echo "Seules les images (jpg, jpeg, png, gif) sont autorisées.";
        }
    } else {
        echo "Aucun fichier n'a été téléchargé ou il y a eu une erreur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Télécharger une image</title>
</head>
<body>
    <h2>Télécharger une image</h2>
    <form action="../Images/upload_image.php" method="POST" enctype="multipart/form-data">
        <label for="image">Choisissez une image :</label>
        <input type="file" name="image" id="image" required>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
