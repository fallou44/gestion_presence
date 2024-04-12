<?php 

function findAllStudents(){
    $student = [
        [ "image" => 'img1.png',
        "nom" => 'elimane',
        "prenom" => 'nging',
        "email" => 'elimane@nging',
        "genre" => 'M',
        "telephone" => '777777777',
        "action" => false
        
    ],
        [ "image" => 'img1.png',
            "nom" => 'seydina',
            "prenom" => 'mhd',
            "email" => 'moussa',
            "genre" => 'M',
            "telephone" => '777777777',
            "action" => false
            
        ],
        [ "image" => 'img1.png',
            "nom" => 'pathe',
            "prenom" => 'pathe',
            "email" => 'pathe',
            "genre" => 'M',
            "telephone" => '777120777',
            "action" => true
            
        ], 
        [ "image" => 'img1.png',
            "nom" => 'modou',
            "prenom" => 'modou',
            "email" => 'modou',
            "genre" => 'M',
            "telephone" => '777347977',
            "action" => false
            
        ],
        [ "image" => 'img1.png',
            "nom" => 'andaw',
            "prenom" => 'andaw',
            "email" => 'andaw',
            "genre" => 'M',
            "telephone" => '777729777',
            "action" => true
            
        ],
        [ "image" => 'img1.png',
            "nom" => 'issa',
            "prenom" => 'issa',
            "email" => 'issa',
            "genre" => 'M',
            "telephone" => '777987777',
            "action" => false
            
    ],
    
    [ "image" => 'img1.png',
    "nom" => 'modou',
    "prenom" => 'ndiaye',
    "email" => 'modou@gmail?com',
    "genre" => 'M',
    "telephone" => '777864799',
    "action" => false
    
],
[ "image" => 'img1.png',
"nom" => 'modou',
"prenom" => 'ndiaye',
"email" => 'modou@gmail?com',
"genre" => 'M',
"telephone" => '777573799',
"action" => false

],
[ "image" => 'img1.png',
"nom" => 'modou',
"prenom" => 'ndiaye',
"email" => 'modou@gmail?com',
"genre" => 'M',
"telephone" => '772387799',
"action" => false

]
    ];

return $student;

}



// fonction pagination
$eleByPage=4 ;
$pageEtu = isset($_GET['pageAff']) ? $_GET['pageAff'] : 1;
$totalPage=ceil(count(findAllStudents())/$eleByPage); //ceil() fonction qui arrondit par exee
// echo($pageEtu<1 || $pageEtu>$totalPage);
if($pageEtu<1 || $pageEtu>$totalPage)
header("Location:?page=$page&pageAff=1");
$eleDeb = ($pageEtu-1)*$eleByPage;
$etudiantsPage = array_slice(findAllStudents(), $eleDeb, $eleByPage);





//  filtrer  par email  
function recherche($filtrer){
            $recherches=findAllStudents();
            $result=[];
        foreach($recherches as  $recherche ) {  

            if($recherche["email"]==trim($filtrer)){
                $result[]=$recherche;
            }       
        }  
        return $result;
        }





        

        // function findStudents($page = 1, $perPage = 4, $filterEmail = null) {
        //     $students = findAllStudents(); // Remplacez cette ligne par la logique pour obtenir tous les étudiants depuis la source de données
        
        //     // Filtrer par email si un filtre est spécifié
        //     if ($filterEmail !== null) {
        //         $filteredStudents = array_filter($students, function($student) use ($filterEmail) {
        //             return $student['email'] == trim($filterEmail);
        //         });
        //     } else {
        //         $filteredStudents = $students;
        //     }
        //     // Pagination
        //     $totalStudents = count($filteredStudents);
        //     $totalPages = ceil($totalStudents / $perPage);
        //     $start = ($page - 1) * $perPage;
        //     $paginatedStudents = array_slice($filteredStudents, $start, $perPage);
        
        //     return [
        //         'students' => $paginatedStudents,
        //         'totalPages' => $totalPages
        //     ];
        // }



?>



