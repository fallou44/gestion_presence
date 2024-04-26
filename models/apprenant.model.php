<?php 
// session_start();
function findAllStudents($referenciel = '') {
    // Récupérez tous les apprenants
    $allStudents = redCsv(PATHAPRENANT, $_SESSION['SESSION']);
    
    // Si aucun référentiel spécifique n'est sélectionné, retournez simplement tous les apprenants
    if (empty($referenciel)) {
        return $allStudents;
    }
    
    // Sinon, filtrez les apprenants par référentiel
    $filteredStudents = array_filter($allStudents, function($student) use ($referenciel) {
        return $student['referentiel'] === $referenciel;
    });

    // Vérifiez si des apprenants ont été trouvés pour le référentiel sélectionné
    // if (empty($filteredStudents)) {
    //     // Aucun apprenant trouvé pour le référentiel sélectionné
    //     echo "Aucun apprenant trouvé pour le référentiel sélectionné.";
    // }

    return $filteredStudents;
}


//  filtrer  par email  
// function recherche($filtrer){
//     $recherches=findAllStudents();
//     $result=[];
// foreach($recherches as  $recherche ) {  

//     if($recherche["nom"]==trim($filtrer)){
//         $result[]=$recherche;
//     }       
// }  
// return $result;
// }

// fonction pagination
$eleByPage=6 ;
$pageEtu = isset($_GET['pageAff']) ? $_GET['pageAff'] : 1;
$totalPage=ceil(count(findAllStudents())/$eleByPage); //ceil() fonction qui arrondit par exee
// echo($pageEtu<1 || $pageEtu>$totalPage);
if($pageEtu<1 || $pageEtu>$totalPage)
header("Location:?page=$page&pageAff=1");
$eleDeb = ($pageEtu-1)*$eleByPage;
$etudiantsPage = array_slice(findAllStudents(), $eleDeb, $eleByPage);




$apprenants =findAllStudents();
$apprenants = $etudiantsPage;
if (isset($_POST["search"])){
    $apprenants= recherche($_POST["search"]);
}






?>



