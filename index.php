<?php

require_once 'config/helpers.php';



    $route = [
        '/' => "login",
        '/apprenant' => 'apprenant',
        '/presence' => 'presence',
        '/promotion' => 'promotion',
        '/referentiel' => 'referentiel',
        
    ];
    
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    require_once "models/".$uri.".model.php";

    echo "models/".$uri.".model.php";
            //  dd($route[$uri]);

 require_once 'templates/partial/header.html.php';

        if(array_key_exists($uri, $route)){
            require_once "templates/".$route[$uri].".html.php" ;
        
        }

//  require_once 'templates/partial/footer.html.php';       


?>