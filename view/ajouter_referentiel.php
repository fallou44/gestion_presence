<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si tous les champs requis sont présents
    if (isset($_POST["libelle"]) && isset($_POST["text"]) && isset($_FILES["image"]["name"]) && isset($_POST["statut"])) {
        // Récupérer les données du formulaire
        $libelle = $_POST["libelle"];
        $description = $_POST["text"];
        $statut = $_POST["statut"];

        // Traitement de l'image téléchargée
        $targetDir = "uploads/"; // Répertoire de téléchargement des images
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Vérifier si le fichier est une image réelle
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Vérifier la taille de l'image
            if ($_FILES["image"]["size"] > 5000000) {
                echo "Désolé, votre fichier est trop volumineux.";
            } else {
                // Déplacer le fichier téléchargé vers le répertoire de destination
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    // Connexion à votre base de données et insertion des données
                    // Assurez-vous d'effectuer une validation et une échappement appropriées des données pour éviter les attaques par injection SQL
                    // Exemple :
                    // $pdo = new PDO("mysql:host=localhost;dbname=votre_base_de_donnees", "votre_utilisateur", "votre_mot_de_passe");
                    // $stmt = $pdo->prepare("INSERT INTO referentiels (libelle, description, image, statut) VALUES (?, ?, ?, ?)");
                    // $stmt->execute([$libelle, $description, $targetFile, $statut]);
                    echo "Le référentiel a été ajouté avec succès.";
                } else {
                    echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
                }
            }
        } else {
            echo "Le fichier n'est pas une image.";
        }
    } else {
        echo "Tous les champs du formulaire sont obligatoires.";
    }
}
?>
