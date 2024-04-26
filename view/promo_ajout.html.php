
<?php
 // Vérifie si le formulaire de création de nouvelle promotion est soumis
 if (isset($_POST["create-promotion"])) {
  $libelle = trim($_POST["libelle"]);
  $date_debut = $_POST["date_debut"];
  $date_fin = $_POST["date_fin"];
  
  // Initialisation des messages d'erreur
  $libelle_error = $date_debut_error = $date_fin_error = '';

  // Vérifie si les champs libellé, date de début et date de fin sont vides
  if (empty($libelle)) {
      $libelle_error = "Le libellé est obligatoire.";
  }
  if (empty($date_debut)) {
      $date_debut_error = "La date début est obligatoire.";
  }
  if (empty($date_fin)) {
      $date_fin_error = "La date fin est obligatoire.";
  

  } else {
    require_once '/var/www/html/projet_new/models/promotion.model.php';
      // Vérifie si la promotion existe déjà dans le fichier CSV
      $promotions = findPromotion();
      $promotionExists = false;
      foreach ($promotions as $promotion) {
          if ($promotion['libelle'] === $libelle) {
              $promotionExists = true;
              break;
          }
      }

      // Si la promotion existe déjà, affiche un message d'erreur
      if ($promotionExists) {
          $error_message = "Une promotion avec le libellé '$libelle' existe déjà. Veuillez en choisir un autre.";
      } else {
          // Si la promotion n'existe pas, procéder à l'ajout
          $file = fopen('/var/www/html/projet_new/data/promotion.csv', 'a');

          // Écrire une nouvelle ligne dans le fichier CSV avec les données de la promotion
          fputcsv($file, array($libelle, $date_debut, $date_fin));

          // Fermer le fichier CSV
          fclose($file);

          // Afficher un message de succès
          $success_message = "La promotion '$libelle' a été ajoutée avec succès.";
      }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ajout promotion</title>
<style>
  .content-toggle .content {
    display: none;
  }

  .toggle-checkbox:checked ~ .content:nth-of-type(1),
  .toggle-checkbox:not(:checked) ~ .content:nth-of-type(2) {
    display: block;
  }

  .toggle-checkbox:checked ~ .toggle-label,
  .toggle-checkbox:not(:checked) ~ .toggle-back {
    display: none;
  }

  /* Style pour la mise en forme, à adapter selon vos besoins */
  .content {
    background-color: var(--white);
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    padding: 5rem 0 8rem 4rem;
    margin-bottom: 200px;
    box-shadow: 10px 5px 5px 5px rgba(216, 213, 213, 0.24);
  }

  .toggle-label, .toggle-back {
    cursor: pointer;
    padding: 15px 20px;
    background-color: #D7DCE0;
    color: #fff;
    border-radius: 5px;
    margin: 10px;
    display: inline-block;
  }
  .toggle-label, .toggle-ajout {
    cursor: pointer;
    padding: 15px 15px;
    background-color: #0E85E6;
    color: #fff;
    border-radius: 5px;
    margin: 10px;
    display: inline-block;
  }


</style>
</head>
<body>

<div class="content-toggle">
  
  <input type="checkbox" hidden id="toggle-checkbox" class="toggle-checkbox" checked> <!-- Ajout de l'attribut checked -->
  <!-- <label for="toggle-checkbox" class="toggle-label">Ajouter référentiel</label> -->
  
  <div class="content" style="margin-top: 150px" >
    <!-- Contenu de la première section -->
    <!-- Ajoutez le contenu que vous voulez afficher par défaut ici -->
    <div class="flex-col-left">
      </div>
      <div class="promo" style=" margin-left: 10px; font-size : 20px" >Promotion</div>
      <div class="flex-col-right">
       
        <br><br>
        <br><br>
        <div class="container-table">
        <?php if (!empty($success_message)) : ?>
    <p style="color: green;"><?php echo $success_message; ?></p>
<?php endif; ?>    
<form action="" method="post">
    <div class="name">
        <label for="libelle">Libellé</label><br>
        <input type="text" name="libelle" id="libelle" placeholder="Entrer le libellé *"><br>
        <?php if (!empty($libelle_error)) : ?>
            <p style="color: red;"><?php echo $libelle_error; ?></p>
        <?php endif; ?>
    </div>
    <div class="date" style="display: flex;">
        <div class="dat-debut">
            <label for="date_debut">Date début</label><br>
            <input type="date" name="date_debut" id="date_debut" style="background-color: white;" placeholder="Entrer la date début *"><br>
            <?php if (!empty($date_debut_error)) : ?>
                <p style="color: red;"><?php echo $date_debut_error; ?></p>
            <?php endif; ?>
        </div>
        <div class="dat-fin">
            <label for="date_fin">Date fin</label><br>
            <input type="date" name="date_fin" id="date_fin" style="background-color: white;" placeholder="Entrer la date fin *"><br>
            <?php if (!empty($date_fin_error)) : ?>
                <p style="color: red;"><?php echo $date_fin_error; ?></p>
            <?php endif; ?>
        </div>
    </div>
    <label for="toggle-checkbox" class="toggle-ajout">Ajouter référentiel</label>
    <div class="button">
        <button class="button2" type="submit" name="create-promotion">Créer promotion</button>
    </div>
</form>

            <br><br>
            <br><br>
            <br><br>
        </div>
    </div>
  </div>

  <div class="content" style=" margin-top : 150px" >
    <div class="flex-col-right">
 
    <!-- Contenu de la deuxième section -->
    <!-- <div class="title">
        <div class="left">Promotion</div>
        <div class="right">Référentiel</div>
        
    </div> -->
  <div class="promo" style=" margin-left: 10px; font-size : 20px" >Promotion</div>

      <div class="flex-col-left">
        </div>
        <div class="promo" style=" margin-left: 10px; font-size : 20px" >Referentiel</div>
    <div class="conteneur">
        <br> <br> <br>
    </div>
   
        <div class="container-table" style="margin-left: 120px; font-size: 15 px " >
            <form action="" method="POST" class="referentiel-form">
                <h3 style="margin-bottom: 10px;">Sélectionner un ou plusieurs référentiels</h3>
                <label for="referentiel1">
                    <input type="checkbox" style="accent-color: #67b7af;" name="referentiels[]" id="referentiel1"
                        value="Referentiel 1"> Referentiel 1
                </label><br>
                <label for="referentiel2">
                    <input type="checkbox" name="referentiels[]" id="referentiel2" value="Referentiel 2"> Referentiel
                    2
                </label><br>
                <label for="referentiel3">
                    <input type="checkbox" name="referentiels[]" id="referentiel3" value="Referentiel 3"> Referentiel
                    3
                </label><br>
                <div class="button_2">
                <label for="toggle-checkbox" style="margin-right: 80px;" class="toggle-back">Back</label>
                <button class="button-2" type="submit">Créer</button>
                </div>
            </form>
            <br><br>
            <br><br>
            <br><br>
        </div>
    
  
  </div>
  </div>
  
  <!-- <label for="toggle-checkbox" class="toggle-back">Ajouter référentiel</label> -->
</div>

</body>
</html>
