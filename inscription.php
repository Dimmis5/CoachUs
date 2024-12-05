if ($_SERVER="REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $identifiant = $_POST['identifiant'];
    $adresse = $_POST['adresse'];
    $numero_telephone = $_POST['numero_telephone'];
    $adresse_mail = $_POST['adresse_mail'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'],PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO coach (nom,prenom,identifiant,adresse,numero_de_telephone,adresse_mail,mot_de_passe) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $nom, $prenom, $identifiant, $adresse, $numero_telephone, $adresse_mail, $mot_de_passe);
}
