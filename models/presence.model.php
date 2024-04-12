<?php  



function listPresence(){  
    $presence  = [
        [
            "matricule" => 'p7_devdat_2024_129',
            "nom" => 'Sow',
            "prenom" => 'Fatou',
            "telephone" => '771234567',
            "referenciel" => 'dev_web',
            "duree" => '05:30',
            "status" => "present"
        ],
        [
            "matricule" => 'p8_devdat_2024_130',
            "nom" => 'Ba',
            "prenom" => 'Mamadou',
            "telephone" => '778765432',
            "referenciel" => 'data',
            "duree" => '07:15',
            "status" => "present"
        ],
        [
            "matricule" => 'p9_devdat_2024_131',
            "nom" => 'Diallo',
            "prenom" => 'Aïssatou',
            "telephone" => '776543210',
            "referenciel" => 'dev_web',
            "duree" => '06:00',
            "status" => "absent"
        ],
        [
            "matricule" => 'p10_devdat_2024_132',
            "nom" => 'Kane',
            "prenom" => 'Modou',
            "telephone" => '770987654',
            "referenciel" => 'data',
            "duree" => '05:45',
            "status" => "present"
        ],
        [
            "matricule" => 'p11_devdat_2024_133',
            "nom" => 'Thiam',
            "prenom" => 'Aïcha',
            "telephone" => '779876543',
            "referenciel" => 'data',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_133',
            "nom" => 'Thiam',
            "prenom" => 'Aïcha',
            "telephone" => '779876543',
            "referenciel" => 'dev_web',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_138',
            "nom" => 'Thiam',
            "prenom" => 'Aïcha',
            "telephone" => '779876543',
            "referenciel" => 'aws',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_193',
            "nom" => 'Thiam',
            "prenom" => 'Aïcha',
            "telephone" => '779876543',
            "referenciel" => 'aws',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_135',
            "nom" => 'Thiam',
            "prenom" => 'Aïcha',
            "telephone" => '779876543',
            "referenciel" => 'hack',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_113',
            "nom" => 'Ndiaye',
            "prenom" => 'Modou',
            "telephone" => '779876543',
            "referenciel" => 'data',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_134',
            "nom" => 'Gning',
            "prenom" => 'Omar',
            "telephone" => '779876543',
            "referenciel" => 'hack',
            "duree" => '06:30',
            "status" => "absent"
        ],
        [
            "matricule" => 'p11_devdat_2024_123',
            "nom" => 'Dieng',
            "prenom" => 'Assane',
            "telephone" => '779876543',
            "referenciel" => 'data',
            "duree" => '06:30',
            "status" => "absent"
        ]

    ];
    
    return $presence;
}


// fonction pour filtrer les presences status


//         function filteredPresence($status = 'status') {

//             $presences = listPresence();

//             if ($status == 'status') {
//                 return $presences;
//             }
//             $filtrerPresence = [];
            
//             foreach ($presences as $presence) {
//                 if ($presence['status'] == $status) {

//                     $filtrerPresence[] = $presence;
//                 }
//             }

//             return $filtrerPresence;
//  }



// filtre et pagination 
$presences=listPresence();
$eleByPage=5;
    $pageEtu = $_GET['pageAff'] ?? 1;         
$_SESSION['affichePresence'] = $_REQUEST;
// var_dump($_SESSION['affichePresence']);
function filtrerPresences($presences) {
    
    $sess=$_SESSION["affichePresence"];
    @$statut_filtre = $sess['status'];
    @$referentiel_filtre = $sess['referenciel'] ;

        return ($statut_filtre == "" || $presences["status"] == $statut_filtre) &&
           ($referentiel_filtre == "" ||  $presences["referenciel"] == $referentiel_filtre);

}

        $listeFiltre = array_filter($presences, 'filtrerPresences');
        
        $totalPage=ceil(count($listeFiltre)/$eleByPage);
     
        if($pageEtu<1 || $pageEtu>$totalPage)
        $pageEtu= 0;
        $eleDeb = ($pageEtu-1)*$eleByPage;
        $etudiantsPage = array_slice($listeFiltre, $eleDeb, $eleByPage);
        // var_dump($etudiantsPage);




        // pagination
            // $eleByPage= 4 ;
            // $pageEtu = isset($_GET['pageAff']) ? $_GET['pageAff'] : 1;
            // $totalPage=ceil(count(listPresence())/$eleByPage); //ceil() fonction qui arrondit par exee
            // // echo($pageEtu<1 || $pageEtu>$totalPage);
            // if($pageEtu<1 || $pageEtu>$totalPage)
            // header("Location:?page=$page&pageAff=1");
            // $eleDeb = ($pageEtu-1)*$eleByPage;
            // $etudiantsPage = array_slice(listPresence(), $eleDeb, $eleByPage);




            

        // filtrer haut de  la page champ de recherche
        function recherche($search){
            $recherches=listPresence();
            $result=[];
        foreach($recherches as  $recherche ) {  

            if($recherche["matricule"]==trim($search)){
                $result[]=$recherche;
            }       
        }  
        return $result;
        }



    

























// function filterPresence($status='status', $ref='referentiel'){
//     $presences = listPresence();
//     if($status == 'status' && $ref == 'referentiel'){
//         return $presences;
//     }

//     $presencesFilter = [];
    
//     foreach($presences as $presence){
//         if($status != 'status' && $ref != 'referentiel'){
//             // Si les deux valeurs sont sélectionnées, filtrez en fonction des deux
//             if($presence['status'] == $status && $presence['referentiel'] == $ref){
//                 $presencesFilter[] = $presence;
//             }
//         } else if($status != 'status') {
//             // Si seul le statut est sélectionné, filtrez en fonction du statut uniquement
//             if($presence['status'] == $status){
//                 $presencesFilter[] = $presence;
//             }
//         } else if($ref != 'referentiel') {
//             // Si seul le référentiel est sélectionné, filtrez en fonction du référentiel uniquement
//             if($presence['referentiel'] == $ref){
//                 $presencesFilter[] = $presence;
//             }
//         }
//     }

//     return $presencesFilter;
// }




?>
    