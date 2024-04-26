<div class="title">
    <div class="left">Apprenants</div>
    <div class="right">Promos * liste * Détail - Apprenants</div>
</div>
<div class="conteneur">
    <div class="contain1">
        <!-- <span>Promotion :</span> -->
        <!-- <a href="/promotion"><span style="color:#038e89"> promotion </span></a> -->
        <?php
// Récupérer le nom du référentiel depuis l'URL
$selectedRef = isset($_GET['referentiel']) ? $_GET['referentiel'] : '';

// Trouver tous les apprenants en fonction du référentiel sélectionné
$apprenants = findAllStudents($selectedRef);

require_once '/var/www/html/projet_new/models/referentiel.model.php';
?>

<!-- <form action="" method="post">
    <select name="referenciel" id="" style="float: right; padding: 10px; border: 1px solid #000; border-radius : 10px ; background :#FFFFFF"  >
        <option value="">Reférenciel</option>
        <option value="Dev Web" <?= $selectedRef == 'Dev Web' ? 'selected' : '' ?>>Developpement Web</option>
        <option value="Dev-data" <?= $selectedRef == 'Dev-data' ? 'selected' : '' ?>> Developpement Data</option>
        <option value="REF-DIG" <?= $selectedRef == 'REF-DIG' ? 'selected' : '' ?>>Referent Digital</option>
        <option value="AWS" <?= $selectedRef == 'AWS' ? 'selected' : '' ?>>AWS</option>
        <option value="Hackeuse" <?= $selectedRef == 'Hackeuse' ? 'selected' : '' ?>>Hackeuse</option>
    </select>
</form> -->

<!-- <form action="" method="post">
    <div class="custom-select" onclick="this.classList.toggle('active')">
        <div class="select-selected">Référenciels</div>

        <div class="select-items">
            <?php
            foreach ($filteredReferentiels as $ref) : ?>
                <div>
                    <input type="checkbox" id="<?= $ref['nom'] ?>" name="referentielPromoSelect[]" value="<?= $ref['nom'] ?>">
                    <label for="<?= $ref['nom'] ?>"><?= $ref['nom'] ?></label>
                </div>
            <?php endforeach ?>
            <button class="btn" type="submit">Valider</button>
        </div>
    </div>
</form> -->

<!-- <form action="" method="post" id="referentielForm"> 
    <div class="custom-select" onclick="this.classList.toggle('active')">
        <div class="select-selected">Référenciels</div>

        <div class="select-items">
            <?php foreach ($filteredReferentiels as $ref) : ?>
                <div>
                    <input type="checkbox" id="<?= $ref['nom'] ?>" name="referentielPromoSelect[]" value="<?= $ref['nom'] ?>" onchange="document.getElementById('referentielForm').submit()"> 
                    <label for="<?= $ref['nom'] ?>"><?= $ref['nom'] ?></label>
                </div>
            <?php endforeach ?>
          
        </div>
    </div>
</form> -->


<?php
// Fonction pour filtrer les apprenants en fonction des référentiels sélectionnés
function filterStudentsByReferentiels($apprenants, $referentiels)
{
    // Vérifie s'il y a des référentiels sélectionnés
    if (isset($_POST['referentielPromoSelect'])) {
        $selectedReferentiels = $_POST['referentielPromoSelect'];
        $filteredApprenants = [];

        // Parcourez chaque apprenant
        foreach ($apprenants as $apprenant) {
            // Vérifiez si le référentiel de l'apprenant fait partie des référentiels sélectionnés
            if (in_array($apprenant['referentiel'], $selectedReferentiels)) {
                $filteredApprenants[] = $apprenant;
            }
        }

        return $filteredApprenants;
    } else {
        // Si aucun référentiel n'est sélectionné, retournez tous les apprenants
        return $apprenants;
    }
}

// Appliquer le filtre aux apprenants
$apprenants = filterStudentsByReferentiels($apprenants, $filteredReferentiels);
// Afficher les apprenants filtrés
// foreach ($apprenants as $apprenant) {
//     // Affichez les détails de l'apprenant
//     echo $apprenant['nom'] . ', ' . $apprenant['prenom'] . ', ' . $apprenant['email'] . ', ' . $apprenant['referentiel'] . '<br>';
// }
?>



<!-- <form action="" method="post" id="referentielForm">
    <div class="custom-select" onclick="this.classList.toggle('active')">
        <div class="select-selected">Référenciels</div>

        <div class="select-items">
            <?php foreach ($filteredReferentiels as $ref) : ?>
                <div>
                    <?php
                    $isChecked = isset($_POST['referentielPromoSelect']) && in_array($ref['nom'], $_POST['referentielPromoSelect']);
                    ?>
                    <input type="checkbox" id="<?= $ref['nom'] ?>" name="referentielPromoSelect[]" value="<?= $ref['nom'] ?>" <?php if ($isChecked) echo 'checked' ?> onchange="document.getElementById('referentielForm').submit()">
                    <label for="<?= $ref['nom'] ?>"><?= $ref['nom'] ?></label>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</form> -->


<style>
    .dev {
        float: inline-end;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    . {
        cursor: pointer;
        padding: 20px;
        width: 200px;
        text-align: center;
        border-radius: 10px;
        background-color: #fff;
        border: 1px solid #ccc;
    }

    .dropdown-content {
        display: none;
        width: 200px;
        /* padding: 20px; */
        border-radius: 15px;
        position: absolute;
        background-color: #f9f9f9;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content label {
        display: flex;
        align-items: center; /* Alignement vertical */
        padding: 10px;
        text-align: center;
        font-size: 15px;
    }

    .dropdown-content label:hover {
        background-color: #ddd;
        border-radius: 5px;
    }

input[type="checkbox"] {
        margin-right: 20px; /* Espacement entre la case à cocher et le texte */
        accent-color: #30E6DF;
    }
</style>


    <script>
        window.onload = function() {
            var dropdownHeader = document.querySelector('.dropdown-header');
            var dropdownContent = document.querySelector('.dropdown-content');

            dropdownHeader.addEventListener('click', function() {
                dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
            });
        };
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
</script>


</head>
<body>
    <!-- <form action="" method="post" class="dev" id="referentielForm">
        <div class="dropdown">
            <div class="dropdown-header">Référentiels</div>
            <div class="dropdown-content">
                <?php foreach ($filteredReferentiels as $ref) : ?>
                    <div style="display: flex; justify-content: space-evenly ; " >
                        <?php
                        $isChecked = isset($_POST['referentielPromoSelect']) && in_array($ref['nom'], $_POST['referentielPromoSelect']);
                        ?>
                        <input type="checkbox" id="<?= $ref['nom'] ?>" name="referentielPromoSelect[]" value="<?= $ref['nom'] ?>" <?php if ($isChecked) echo 'checked' ?> onchange="document.getElementById('referentielForm').submit()">
                        <label for="<?= $ref['nom'] ?>"><?= $ref['nom'] ?></label>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </form> -->

    <form action="" method="post">
    <div class="custom-select" style="float: inline-end;  " >
        <input hidden type="checkbox" name="referentiel" value="1" id="referentiel">
        <label style="margin-left: 50px; font-size: 15px; " for="referentiel" class="select-selected dropdown" onclick="toggleSelectItems()">Référentiels</label>
        <div class="select-items" id="selectItems">
            <!-- Ajout de l'option "All" -->
            <div>
                <input type="checkbox"
                       name="referentielPromoSelect[]"
                       id="all" 
                       <?php if (isset($_POST['referentielPromoSelect']) && in_array('all', $_POST['referentielPromoSelect'])) echo 'checked'; ?>
                       value="all" onclick="checkAll(this)">
                <label for="all">All</label>
            </div>
            <!-- Fin de l'ajout de l'option "All" -->
            <?php foreach ($filteredReferentiels as $ref) : ?>
                <div>
                    <input type="checkbox"
                           name="referentielPromoSelect[]"
                           id="<?= $ref['nom'] ?>" <?php if (in_array($ref['nom'], $_POST['referentielPromoSelect'] ?? [])) echo 'checked'; ?>
                           value="<?= $ref['nom'] ?>" onclick="this.form.submit()">
                    <label for="<?= $ref['nom'] ?>"><?= $ref['nom'] ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</form>

<script>
    function checkAll(source) {
        var checkboxes = document.getElementsByName('referentielPromoSelect[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
        // Soumettre automatiquement le formulaire après avoir coché tous les éléments
        source.form.submit();
    }
</script>


<script>
    function toggleSelectItems() {
        var selectItems = document.getElementById('selectItems');
        if (selectItems.style.display === 'none') {
            selectItems.style.display = 'block';
            localStorage.setItem('referentiel', true);
        } else {
            selectItems.style.display = 'none';
            localStorage.setItem('referentiel', false);
        }
    }

    // Vérifier l'état du div contenant les select-items au chargement de la page
    if (localStorage.getItem('referentiel') === 'true') {
        document.getElementById('selectItems').style.display = 'block';
        document.getElementById('referentiel').checked = true;
    } else {
        document.getElementById('selectItems').style.display = 'none';
        document.getElementById('referentiel').checked = false;
    }
</script>


    <!-- <form action="" method="post">
            <div class="custom-select">
                <input hidden type="checkbox" name="referentiel" value="1" id="referentiel">
                <label for="referentiel" class="select-selected dropdown" onclick="toggleSelectItems()">Référenciels</label>
                <div class="select-items" id="selectItems">
                    <?php foreach ($filteredReferentiels as $ref) : ?>
                        <div>
                            <input type="checkbox"
                                   name="referentielPromoSelect[]"
                                   id="<?= $ref['libelle'] ?>" <?php if (in_array($ref['libelle'], $_POST['referentielPromoSelect'] ?? [])) echo 'checked'; ?>
                                   value="<?= $ref['libelle'] ?>" onclick="this.form.submit()">
                            <label for="<?= $ref['libelle'] ?>"><?= $ref['libelle'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </form>



        <script>
    function toggleSelectItems() {
        var selectItems = document.getElementById('selectItems');
        if (selectItems.style.display === 'none') {
            selectItems.style.display = 'block';
            localStorage.setItem('referentiel', true);
        } else {
            selectItems.style.display = 'none';
            localStorage.setItem('referentiel', false);
        }
    }

    // Vérifier l'état du div contenant les select-items au chargement de la page
    if (localStorage.getItem('referentiel') === 'true') {
        document.getElementById('selectItems').style.display = 'block';
        document.getElementById('referentiel').checked = true;
    } else {
        document.getElementById('selectItems').style.display = 'none';
        document.getElementById('referentiel').checked = false;
    }
</script> -->

<script>
    // Fonction pour soumettre le formulaire lorsqu'un changement est détecté
    function applyFilter() {
        document.getElementById('referentielForm').submit();
    }

    // Ajoutez un écouteur d'événements à chaque case à cocher
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', applyFilter);
    });
</script>


<style>
                /* Style général */
.custom-select {
    position: relative;
    display: inline-block;
    width: 200px; /* Largeur de la liste déroulante */
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Style de l'élément sélectionné */
.custom-select .select-selected {
    background-color: #f2f2f2;
    padding: 8px 10px;
    cursor: pointer;
}

/* Flèche pour indiquer le déroulement */
.custom-select .select-selected:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 10px;
    margin-top: -3px;
    border-width: 6px 6px 0 6px;
    border-style: solid;
    border-color: #888 transparent transparent transparent;
}

/* Style de la liste des options */
.custom-select .select-items {
    display: none;
    position: absolute;
    background-color: #fff;
    width: calc(100% - 2px); /* Largeur de la liste déroulante moins la bordure */
    max-height: 200px; /* Hauteur maximale de la liste déroulante */
    overflow-y: auto;
    border: 1px solid #ccc;
    border-top: none;
    z-index: 99;
}

.custom-select .select-items .btn {
    background-color: rgb(22, 145, 114);
    padding: 8px 10px;
    cursor: pointer;
    color: #fff;
    width:calc(100% - 2px);
}

/* Affichage de la liste lorsqu'elle est activée */
.custom-select.active .select-items {
    display: block;
}

/* Style des options */
.custom-select .select-items div {
    padding: 8px 10px;
    cursor: pointer;
}

/* Effet hover sur les options */
.custom-select .select-items div:hover {
    background-color: #ddd;
}
            </style>
<!-- <div class="dropdown" style=" display: flex; justify-content: flex-end; margin-right: 20px;  ;" >
    <div class="dropdown-header" onclick="toggleDropdown()">Référentiels <i class="fas fa-caret-down"></i></div>
    <div class="dropdown-content">
        <label><input type="checkbox" name="referenciel" value="Dev Web"> Développement Web</label>
        <label><input type="checkbox" name="referenciel" value="Dev-data"> Développement Data</label>
        <label><input type="checkbox" name="referenciel" value="REF-DIG"> Référent Digital</label>
        <label><input type="checkbox" name="referenciel" value="AWS"> AWS</label>
        <label><input type="checkbox" name="referenciel" value="Hackeuse"> Hackeuse</label>
        <button onclick="applyFilter()">Filtrer</button>
    </div>
</div> -->
<style>
    .dropdown {
    position: relative;
    display: inline-block;

}

.dropdown-header {
    
    cursor: pointer;
    padding: 10px 15px;
    border-radius: 10px;
    background-color: #fff;
    border: 1px solid #ccc;
}

.dropdown-content {
    display: none;
    padding: 20px;
    border-radius: 15px;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content label {
    display: block;
    padding: 10px;
}

.dropdown-content label:hover {
    background-color: #ddd;
    border-radius: 5px;
}

.dropdown-content input[type="checkbox"] {
    margin-right: 5px;
    accent-color: #30E6DF;
}
</style>
        <br> <br> <br>
    </div>
    <div class="contain2">
        <span>Referentiel :</span>
        <span>Dev Web/mobile</span>
    </div>
</div>  
<div class="content" style="margin-bottom:300px ;">
    <!-- partie2 lister apprenants -->
    <div class="flex-col-left">
    </div>
    <div class="flex-col-right">
        <div class="line2">
            <div class="div1"> Liste Des Apprenants </div>
            <!-- <span>(50)</span>  -->
            <div class="div2">
                <button class="new btn" onclick="window.location.href='#popup'">+ Nouveau</button>
                <button class="insert btn" onclick="window.location.href='#popupFILE'">Insertion en masse</button>
                <button class="file btn"><span><i class="fa-solid fa-download"> </i> Fichier
                        modèle</span></button>
                <button class="list btn">Liste des Exclus</button>
            </div>
        </div>
        <form class="line3" action="" method="post">
            <span><i class="fa-solid fa-magnifying-glass"></i></span>
            <input style="outline: none; display:flex; border-radius: 10px; background-color: #f8f4f4; width: 100%; margin-top: 12px;" type="text" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>" placeholder="filter ici...">
            <button style="margin-top: 12px; padding: 12px; float: right ; background-color: #037773; border-radius: 10px; margin: 20px; color: #f2f1ff; " type="submit"><i class="fa-solid fa-rotate"></i></button>
        </form>

        <!-- <div class="line4"><img src="public/images/img.png" width="5%" height="10%"></div> -->
        <i class="fa-regular fa-folder-open" style="color: #63E6BE; font-size: 45px;"></i>

        <br><br>
        <br><br>
        <br><br>

        <?php
// Récupérer la valeur du paramètre referentiel depuis l'URL
$selectedRef = isset($_GET['referentiel']) ? $_GET['referentiel'] : '';

// Trouver tous les apprenants en fonction du référentiel sélectionné
$apprenants = findAllStudents($selectedRef);

$apprenants = filterStudentsByReferentiels($apprenants, $filteredReferentiels);
 ?>
        <div class="container-table">
            <?php if (empty($apprenants)) : ?>
                <div class="text" style="display: flex; align-items: center; justify-content: center; font-size: large; " >
                    Aucun apprenant n'a été pas trouvé cette promotions.
                </div>
                <br><br>
        <br><br>
        <br><br>
            <?php else : ?>
                <table class="line5">
                    <tr>
                        <th class="titre" data-label="Image">Image</th>
                        <th class="titre" data-label="Nom">Nom</th>
                        <th class="titre prenom" data-label="Prenom">Prenom</th>
                        <th class="titre email1" data-label="Email">Email</th>
                        <th class="titre email1" data-label="Email">Referentiel</th>
                        <th class="titre" data-label="Genre">Genre</th>
                        <th class="titre" data-label="Telephones">Telephones</th>
                        <th class="titre" data-label="Actions">Actions</th>
                    </tr>
                    <tbody>
                        <?php foreach ($apprenants as $row) : ?>
                            <tr class="line">
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas"><img src="https://imgs.search.brave.com/2-mL1a95ogQh8F5fREvDxO2fqfBcc_0MGdgKFosZjwU/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9wbHVz/cG5nLmNvbS9pbWct/cG5nL3VzZXItcG5n/LWljb24tdXNlci0y/LWljb24tcG5nLWZp/bGUtNTEyeDUxMi1w/aXhlbC01MTIucG5n" width="30px"></div>
                                </td>
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $row['nom'] ?></div>
                                </td>
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas" style="color:rgb(29, 109, 29);"><?= $row['prenom'] ?></div>
                                </td>
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas email"><?= $row['email'] ?></div>
                                </td>
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas email"><?= $row['referentiel'] ?></div>
                                </td>
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas"><?= $row['genre'] ?></div>
                                </td>
                                <td class="bloc">
                                    <div class="col-haut"></div>
                                    <div class="col-bas"><?= $row['telephone'] ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="pagination" style="padding: 29px; font-size: 20px">
                    <a href="#" class="page-link prev"><i class="fas fa-angle-left"></i></a>
                    <?php for ($i = 1; $i <= $totalPage; $i++) {
                            if ($i == $pageEtu) {
                                echo "<a href='?pageAff=$i' class='page-link active'>$i</a>";
                            } else {
                                echo "<a href='?pageAff=$i' class='page-link'>$i</a>";
                            }
                        }
                    ?>
                    <a href="#" class="page-link next"><i class="fas fa-angle-right"></i></a>
                    <!-- Ajoutez plus de liens pour plus de pages -->
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

    <!-- Le Modal (popup) -->
    <div class="container-popup">
        <div id="popup2" class="modal">
            <!-- Contenu du Modal -->
            <form action="" method="post" class="modal-content">
                <div class="head">
                    <a href="#" class="close">×</a>
                    <h2>Nouvel Apprenant</h2>
                </div>
                <div class="section informations-perso">
                    <div class="line flex">
                        <span><i class="fa-solid fa-pen"></i></span>
                        <span>Informations Perso.</span>
                        <span></span>
                        <span><i class="fa-solid fa-2"></i></span>
                        <span>Informations Supplémentaires</span>
                    </div>
                    <div class="input-group">
                        <div>
                            <label for="nom_tuteur">Nom et Prénom tuteur</label>
                            <input type="text" id="nom_tuteur" placeholder="Nom & Prénom tuteur" required>
                        </div>
                        <div>
                            <label for="contact_tuteur">Contact Tuteur</label>
                            <input type="text" id="contact_tuteur" placeholder="Contact Tuteur" required>
                        </div>
                        <div>
                            <label for="photocopie_cni">Photocopie CNI</label>
                            <input type="file" id="photocopie_cni" placeholder="Photocopie CNI" required>
                        </div>
                        <div>
                            <label for="extrait_naissance">Extrait de naissance</label>
                            <input type="file" id="extrait_naissance" placeholder="Extrait de naissance" required>
                        </div>
                        <div>
                            <label for="diplome">Diplôme</label>
                            <input type="file" id="diplome" placeholder="Diplôme">
                        </div>
                        <div>
                            <label for="casier_judiciaire">Casier Judiciaire</label>
                            <input type="file" id="casier_judiciaire" placeholder="Casier Judiciaire" required>
                        </div>
                        <div>
                            <label for="visite_medicale">Visite Médicale</label>
                            <input type="file" id="visite_medicale" placeholder="Visite Médicale" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="section">
                    <div class="btn-container">
                        <a href="#" class="btn underline-none cancel-btn "> X Annuler</a>
                        <a href="#" type="submit" class="btn underline">+ Créer nouvel apprenant</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container-popup2">

        <div id="popup" class="modal">

            <!-- Contenu du Modal -->
            <form action="" method="post" class="modal-content">
                <div class="head">
                    <a href="#" class="close">×</a>
                    <h2>Nouvel Apprenant</h2>
                </div>
                <div class="section informations-perso">
                    <div class="line flex">
                        <span><i class="fa-solid fa-1"></i></span>
                        <span>Informations Perso.</span>
                        <span></span>
                        <span><i class="fa-solid fa-2" style="color: #038e89;background: #f2f1ff"></i></span>
                        <span>Informations Supplémentaires</span>
                    </div>
                    <div class="input-group">
                        <div>
                            <label for="nom_tuteur">Nom et Prénom tuteur</label>
                            <input type="text" id="nom_tuteur" placeholder="Nom & Prénom tuteur" required>
                        </div>
                        <div>
                            <label for="contact_tuteur">Contact Tuteur</label>
                            <input type="text" id="contact_tuteur" placeholder="Contact Tuteur" required>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Entrer l'email" required class="input-group input[type='email']">
                        </div>
                        <div>
                            <label for="telephone">Telephone</label>
                            <input type="text" id="telephone" placeholder="Entrer le telephone" required>
                        </div>
                        <div>
                            <label for="sexe">Sexe</label>
                            <select name="sexe" id="sexe" class="input-group select">
                                <option value="masculin">Masculin</option>
                                <option value="feminin">Feminin</option>
                            </select>
                        </div>
                        <div class="date-input-container">
                            <label for="casier_judiciaire">Date de Naissance</label>
                            <input type="date" id="date_naissance" placeholder="MM/DD/YYYY" required>
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                        <div>
                            <label for="visite_medicale">Lieu de Naissance</label>
                            <input type="text" id="lieu_naissance" placeholder="Entrer le lieu de naissance" required>
                        </div>
                        <div>
                            <label for="visite_medicale">Ṇ̣° CNI</label>
                            <input type="text" id="lieu_naissance" placeholder="Entrer le numero de votre carte d'identité" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="section">
                    <div class="btn-container">
                        <a href="#popup2" class="btn" class="btn underline">Suivant</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="excel" id="popupFILE">
        <div class="popup">
            <div class="popup-header">Choisir un Fichier Excel</div>
            <div class="upload">
                <div class="chose-file"><input type="file" class="hidden-input" id="fileInput" accept=".xlsx, .xls, .ods" hidden>
                    <label for="fileInput" class="drop-zone">
                        <span class="drop-zone-text" style="font-size: 20px;">Drop file here or click to upload</span>
                    </label>
                </div>
            </div>
            <div class="footer-btns">
                <a href="#" class="btn btn-red">Fermer</a>
                <button type="submit" form="formExcel" class="btn btn-green">Enregistrer</button>
            </div>
        </div>
    </div>

 <!-- <script>
  // Supprimer la fonction toggleDropdown()

// Modifier la fonction pour fermer le dropdown lorsqu'on clique à l'extérieur
window.addEventListener('click', function(event) {
    var dropdownContent = document.querySelector('.dropdown-content');
    if (!event.target.closest('.dropdown')) {
        dropdownContent.style.display = 'none';
    }
});

// Ajouter une fonction pour soumettre le formulaire lorsque des cases à cocher sont cliquées
function applyFilter() {
    var checkboxes = document.querySelectorAll('.dropdown-content input[type="checkbox"]:checked');
    var selectedValues = [];
    checkboxes.forEach(function(checkbox) {
        selectedValues.push(checkbox.value);
    });
    console.log(selectedValues); // Remplacez cette ligne par votre logique de filtrage

    // Soumettre le formulaire
    document.getElementById('referentielForm').submit();
}

// Empêcher la fermeture du dropdown lorsqu'une checkbox est cliquée
document.querySelectorAll('.dropdown-content input[type="checkbox"]').forEach(function(checkbox) {
    checkbox.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});


 </script> -->
