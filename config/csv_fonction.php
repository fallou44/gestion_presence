<?php  
                /* Lire les données d'un fichier CSV */
                function redCsv($fichier, $filename) {
                    $rows = array_map('str_getcsv', file($fichier));
                    $header = array_shift($rows);
                    $data = array();
                    foreach ($rows as $row) {
                        if ($row[7]==$filename)
                        $data[] = array_combine($header,$row);
                    }
                    return $data;
                }
                function redCsvRef($fichier, $filename) {
                    $rows = array_map('str_getcsv', file($fichier));
                    $header = array_shift($rows);
                    $data = array();
                    foreach ($rows as $row) {
                        if ($row[7]==$filename)
                        $data[] = array_combine($header,$row);
                    }
                    return $data;
                }
                function redCsvPromo($fichier) {
                    $rows = array_map('str_getcsv', file($fichier));
                    $header = array_shift($rows);
                    $data = array();
                    foreach ($rows as $row) {
                                // if ($row [3]==1){
                                //     $_SESSION['SESSION']=$row[7];
                                // }
                        $data[] = array_combine($header, $row);
                    }
                    return $data;
                }
                function savefile($fichier, $data){
                    $fp = fopen($fichier, 'w');
                    fputcsv($fp, array_keys(current($data))); 
                    foreach ($data as $fields) {
                        fputcsv($fp, $fields);
                    }
                    fclose($fp);
                }
?> 
