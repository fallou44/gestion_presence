<?php 

    function findPromotion(){
 
        // savefile(PATHPROMOTION, $promotion);

        $promotion = redCsvPromo(PATHPROMOTION);

        return $promotion;
    }
        // filtrer haut de  la page champ de recherche
        function recherche($search){
            $recherches=findPromotion();
            $result=[];
        foreach($recherches as  $recherche ) {  

            if($recherche["libelle"]==trim($search)){
                $result[]=$recherche;
            }       
        }  
        return $result;
        }
?>