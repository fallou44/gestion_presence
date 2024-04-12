<?php 

    function findAllReferentiels(){
        $referentiel = [
            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
            "nom" => 'Dev Web/mobile',
            "statut" => 'Active',
            "action" => false
        ],
            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
                "nom" => 'Référence Digital',
                "statut" => 'Active',
                "action" => false
            ],
            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
                "nom" => 'AWS',
                "statut" => 'Active',
                "action" => true
            ],
            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
                "nom" => 'Dev Web/mobile',
                "statut" => 'Active',
                "action" => false   
            ],
            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
                "nom" => 'Dev Web/mobile',
                "statut" => 'Active',
                "action" => false
            ],
            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
                "nom" => 'Dev Web/mobile',
                "statut" => 'Active',
                "action" => true
            ],

            [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
            "nom" => 'Dev Web/mobile',
            "statut" => 'Active',
            "action" => true
        ],
        [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
        "nom" => 'Dev Web/mobile',
        "statut" => 'Active',
        "action" => true
    ],
    [ "image" => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE0cnxfmp6qG9-nSGkKy7yQgaCNnxdgYJ-BIben91IXRQOfVXieiVHPQfEovSQ4swQuL8&usqp=CAU',
    "nom" => 'Dev Web/mobile',
    "statut" => 'Active',
    "action" => true
],


        ];

        return $referentiel;
    }



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

?>