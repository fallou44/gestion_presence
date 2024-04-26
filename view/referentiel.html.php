<?php
$empty_libelle = false;
$empty_description = false;

// Vérifie si le formulaire de création de nouveau référentiel est soumis
if (isset($_POST["new-referentiel"])) {
	$libelle = trim($_POST["libelle"]);
	$description = $_POST["description"];
	$promo = $_SESSION["SESSION"]; // Récupère la promotion active de la session

	// Vérifie si les champs libellé et description sont vides
	if (empty($libelle) && empty($description)) {
		$empty_libelle = true;
		$empty_description = true;
	} else {
		if (empty($libelle) && !empty($description)) {
			$empty_libelle = true;
			$empty_description = false;
		}
		if (!empty($libelle) && empty($description)) {
			$empty_libelle = false;
			$empty_description = true;
		}
	}

	// Vérifie si les champs obligatoires sont vides
	if (!$empty_libelle && !$empty_description) {
		// Vérifie si le référentiel existe déjà dans la promotion active de la session
		$referentiel = findAllReferentiels();
		// Vérifie si le référentiel existe déjà dans la promotion active de la session
		$referentielExists = false;
		foreach ($referentiel as $referent) {
			if (isset($referent['nom']) && isset($referent['promo']) && $referent['nom'] === $libelle && $referent['promo'] === $promo) {
				$referentielExists = true;
				break;
			}
		}


		// Si le référentiel existe déjà dans la promotion active, affiche un message d'erreur
		if ($referentielExists) {
			$error_message = "Un référentiel avec le libellé <strong>'$libelle'</strong> existe déjà dans la promotion active. Veuillez en choisir un autre.";
		} else {
			// Si le référentiel n'existe pas dans la promotion active, vérifie s'il existe dans d'autres promotions
			$file = fopen('/var/www/html/projet_new/data/referentiel.csv', 'r');
			while (($row = fgetcsv($file)) !== false) {
				// Vérifie si le libellé existe déjà dans le fichier CSV pour d'autres promotions
				if ($row[2] === $libelle) {
					$referentielExists = true;
					break;
				}
			}
			fclose($file);

			// Si le référentiel existe déjà dans d'autres promotions, affiche un message d'erreur
			if ($referentielExists) {
				$error_message = "Un référentiel avec le libellé <strong>'$libelle'</strong> existe déjà dans d'autres promotions. Veuillez en choisir un autre.";
			} else {
				// Si le référentiel n'existe pas déjà, procéder à l'ajout du référentiel
				$selected_image = "";
				// Vérifie si une image a été téléchargée
				if (!empty($_FILES["image"]["name"])) {
					$selected_image = $_FILES["image"]["name"];
				}
				$imagePath = "";

				// Si aucune image n'est sélectionnée, utilisez l'image par défaut
				if (empty($selected_image)) {
					$default_image = "../public/images/versionner.png"; // Chemin de l'image par défaut
					$imagePath = $default_image;
				} else {
					// Sinon, utilisez l'image téléchargée
					$imagePath = saveReferentielImage($selected_image);
				}

				// Récupérer le statut du référentiel à partir du champ caché
				$statut = $_POST["statut"];

				// Si le statut est "Active", liez le référentiel à la promotion active, sinon, laissez-le non lié
				$promo = $statut === "Active" ? $_SESSION["SESSION"] : " ";

				// Ouvrir le fichier CSV en mode ajout
				$file = fopen('/var/www/html/projet_new/data/referentiel.csv', 'a');

				// Écrire une nouvelle ligne dans le fichier CSV avec les données du formulaire
				fputcsv($file, array(1, $imagePath, $libelle, $statut, "", "", $description,  $promo, "", ""));

				// Fermer le fichier CSV
				fclose($file);
			}
		}
	}
}

?>


<link rel="stylesheet" href="/var/www/html/projet_new/public/css/referentiel.css">
<div class="promotions">
	<h3>Référentiels</h3>
	<span>Référentiels * Création</span>
</div>
<form method="post">
	<select name="filterSelect" style="margin: 15px; padding: 10px; background-color: white; border-radius: 10px; border: 1px solid black" onchange="this.form.submit()">
		<option value="all" <?= $selectedFilter === 'all' ? 'selected' : '' ?>>Tous les référentiels</option>
		<option value="active" <?= $selectedFilter === 'active' ? 'selected' : '' ?>>Référentiel Actif</option>
		<option value="inactive" <?= $selectedFilter === 'inactive' ? 'selected' : '' ?>>Référentiel Inactif</option>
	</select>
	<!-- <button style="background-color: #029386 ; padding : 7px; border-radius : 5px; color : white "  type="submit">Valider</button> -->
	<!-- <button style="margin-top: 12px; padding: 12px; float: right ; background-color: #037773; border-radius: 10px; margin: 20px; color: #f2f1ff; " type="submit"><i class="fa-solid fa-rotate"></i></button> -->
</form>
<div class="referent">
	<div class="main">
		<?php
		$selectedFilter = isset($_POST['filterSelect']) ? $_POST['filterSelect'] : 'all';
		$filteredReferentiels = filterReferentiels(findAllReferentiels(), $selectedFilter);
		$refDig = findAllReferentiels();
		if (isset($_POST["search"])) {
			$refDig = recherche($_POST["search"]);
		}
		$referentiel = findAllReferentiels();
		// var_dump($referentiel);

		// Vérifier si le filtre est vide
		if (empty($filteredReferentiels)) {
			echo '<h2>Aucun référentiel trouvé pour le filtre sélectionné.</h2>';
		} else
			foreach ($filteredReferentiels as $referent) :  ?>
			<div class="img">
				<a style="margin-left: 12px;" href="http://serigne.fallou.seck:8284/apprenant?referentiel=<?= $referent['nom'] ?>"><img src="<?= $referent['image'] ?>" alt="">

					</span>
					<?php
					?>
				</a>
				<div class="ref">
					<span><?= $referent['nom'] ?></span> <br>
					<span class="<?= strtolower($referent['statut']) === 'active' ? 'active-green' : 'inactive-red' ?>">
						<?= $referent['statut'] ?>
					</span>

				</div>
				<style>
					.active-green {
						color: green;
					}

					.inactive-red {
						color: red;
					}
				</style>

			</div>
		<?php endforeach; ?>
	</div>

	<div class="formRef" style="padding-right:22px ; padding-left:22px ;">
		<h4 style="font-size: 20px;">Nouveau Référentiel</h4>
		<?php if (!empty($error_message)) : ?>
			<p style="color: red;"><?php echo $error_message; ?></p>
		<?php endif; ?>
		<form action="" method="post" enctype="multipart/form-data" style=" padding : -50px ">

			<input type="hidden" name="new-referentiel">
			<span style="font-size: 19px;">Libelle</span> <br>
			<!-- <i class="fa-regular fa-user" class="first-user"></i> -->
			<!-- Ajouter un champ caché pour le statut -->
			<input type="hidden" name="statut" id="statut" value="Inactive">

			<!-- Ajouter un événement onChange au toggle pour mettre à jour le champ statut -->
			<input type="checkbox" id="toggle" class="toggle-input" onchange="updateStatut(this)">

			<input type="text" name="libelle" class="libelle" placeholder=" entrer le Libelle"> <br>
			<?php if ($empty_libelle) echo "<p style='color: red; '>le libelle est obligatoire</p>" ?>
			<!-- <i class="fa-regular fa-user" class="twon-user"></i> -->
			<input type="text" name="description" id="description" cols="10" rows="5" placeholder="entrer la  descrition"></input>
			<?php if ($empty_description) echo "<p style='color: red; '>la description est obligatoire</p>" ?>
			<!-- Ajout du champ pour l'image -->
			<div class="toggle">
				<input type="checkbox" id="toggle" class="toggle-input">
				<label for="toggle" class="toggle-label">
					<span class="toggle-text toggle-text--left">Inactive</span>
					<span class="toggle-handle"></span>
					<span class="toggle-text toggle-text--right">Active</span>
				</label>
			</div>
			<div class="flex-image" style="display: flex; margin-top : -41px">
				<input type="file" style="border: none; padding: 2px " name="image" accept="image/*,.doc,.csv,.docx,application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="previewFile(this)">


				<div>
					<img id="preview" src="../public/images/versionner.png" alt="Aperçu de l'image" style="width: 50px; max-height: 90px; margin-top:10px; border-radius: 10% ">
				</div>
				<p id="fileTypeError" style="color: red; display: none; margin-top: 10px;">Le type de fichier choisi n'est pas bon.</p>
				<!-- Ajout du toggle pour activer/désactiver -->

			</div>
			<!-- Affichage de l'image sélectionnée -->
			<!-- <div id="image-preview" style="margin-top: 10px;"></div> -->
			<button class="btn" style="margin-top: -50px;" type="submit">Enregistrer</button>
		</form>
	</div>
</div>

<style>
	/* Styles pour le conteneur du bouton basculant */
	.toggle {
		margin-top: -5px;
		display: inline-block;
		position: relative;
		width: 100px;
		height: 50px;
	}

	/* Styles pour l'élément de saisie (input) */
	.toggle-input {
		display: none;
	}

	/* Styles pour l'étiquette (label) */
	.toggle-label {
		display: block;
		width: 70%;
		height: 70%;
		background-color: #ddd;
		border-radius: 25px;
		cursor: pointer;
		position: relative;
		transition: background-color 0.3s;
	}

	/* Styles pour le texte */
	.toggle-text {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		color: transparent;
		/* Pour masquer les valeurs */
	}

    /* Styles pour la poignée du bouton */
    .toggle-handle {
        position: absolute;
        top: -14px;
        width: 46%;
        height: calc(100% - 4px);
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        transition: left 0.3s; /* Ajout de la transition pour une animation fluide */
    }

	/* Styles pour le bouton basculant lorsque la case est cochée */
	.toggle-input:checked+.toggle-label .toggle-handle {
		left: 52%;
	}

	/* Styles pour le bouton basculant lorsque la case n'est pas cochée */
	.toggle-input:not(:checked)+.toggle-label .toggle-handle {
		left: 2px;
	}
</style>
<!-- Script pour prévisualiser l'image sélectionnée -->
<script>
	function previewFile(input) {
		var file = input.files[0];
		var preview = document.getElementById('preview');
		var fileTypeError = document.getElementById('fileTypeError');

		if (file) {
			var fileType = file.type.split('/')[0];
			if (fileType === 'image') {
				var reader = new FileReader();

				reader.onload = function(event) {
					preview.src = event.target.result;
					preview.style.display = 'block';
					fileTypeError.style.display = 'none';
				}

				reader.readAsDataURL(file);
			} else {
				preview.style.display = 'none';
				fileTypeError.style.display = 'block';
			}
		}
	}
</script>
<!-- JavaScript pour mettre à jour le champ statut en fonction de l'état du toggle -->
<script>
    function updateStatut(toggle) {
        var statutInput = document.getElementById('statut');
        var toggleHandle = document.querySelector('.toggle-handle'); // Sélectionnez la poignée du bouton

        if (toggle.checked) {
            statutInput.value = 'Active';
            toggleHandle.style.left = '52%'; // Positionnez la poignée à droite lorsque le toggle est activé
            toggleHandle.style.backgroundColor = 'green'; // Définissez la couleur de fond en vert lorsque le toggle est activé
        } else {
            statutInput.value = 'Inactive';
            toggleHandle.style.left = '2px'; // Positionnez la poignée à gauche lorsque le toggle est désactivé
            toggleHandle.style.backgroundColor = 'red'; // Définissez la couleur de fond en rouge par défaut
        }
    }
</script>
