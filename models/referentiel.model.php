<?php 
    function findAllReferentiels(){
        // savefile(PATHREFERENTIEL, $referentiel);
        $referentiel = redCsvRef(PATHREFERENTIEL,$_SESSION['SESSION']);
        return $referentiel;
    }

// Récupérer la valeur du filtre sélectionné depuis le formulaire
$selectedFilter = isset($_POST['filterSelect']) ? $_POST['filterSelect'] : 'all';

// Définir la fonction de filtrage
function filterReferentiels($referentiels, $selectedFilter) {
    $filteredReferentiels = [];

    foreach ($referentiels as $referentiel) {
        if ($selectedFilter === 'all' || 
            ($selectedFilter === 'active' && $referentiel['statut'] === 'Active') || 
            ($selectedFilter === 'inactive' && $referentiel['statut'] === 'Inactive')) {
            $filteredReferentiels[] = $referentiel;
        }
    }

    return $filteredReferentiels;
}
// Appel de la fonction pour filtrer les référentiels
$filteredReferentiels = filterReferentiels(findAllReferentiels(), $selectedFilter);
        // filtrer haut de  la page champ de recherche
        function recherche($search){
            $recherches=findAllReferentiels();
            $result=[];
        foreach($recherches as  $recherche ) {  

            if($recherche["nom"]==trim($search)){
                $result[]=$recherche;
            }    
        }  
        return $result;
        }
        

        function saveReferentielImage($imageFile){
            $targetDirectory = "../public/images/";
        
            // Vérifie si le répertoire de destination existe, sinon le crée
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0777, true);
            }
        
            $targetFile = $targetDirectory . basename($imageFile);
            
            // var_dump($_FILES["image"]["tmp_name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                // var_dump('entre');
                return false;
            }
        }
?>