<?php
// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises
    $libelle = $_POST['libelle'];
    $description = $_POST['text'];
    $statut = $_POST['statut'];

    // Traitement de l'image
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Effectuer l'opération d'ajout du référentiel dans la base de données
    // Assurez-vous d'effectuer les validations nécessaires et de sécuriser vos requêtes SQL

    // Après l'ajout réussi, redirigez l'utilisateur vers une page de succès ou affichez un message de succès
}
?>
