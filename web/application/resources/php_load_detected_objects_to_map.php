<?php
    include "../views/_templates/init.php";
    try {

        if(isset($_POST['jsonData'])){
    $jsonData = $_POST['jsonData'];
    $thresholdValue = $_POST['threshold'];
    $command = $_POST['command'];
    $dataToWrite = ['threshold' => $thresholdValue];
    $jsonDataToWrite = json_encode($dataToWrite);
    $outputFilePath = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\05_model_input\yolox_confidence.json";
    file_put_contents($outputFilePath, $jsonDataToWrite);
            shell_exec($command);
        $currentTime = time(); // Current Unix timestamp
        $oneSecondAgo = $currentTime - 180;
          $conff =$_POST["threshold"];
          $strQuery = 'SELECT id, name as "Name", ROUND(conf::numeric, 4) as conf, ST_AsGeoJSON(geom, 5) as geom, ST_X(ST_AsText(geom,3)) AS "lon", ST_Y(ST_AsText(geom,3)) AS "lat" FROM yolox_all_targets WHERE conf >='. $conff . ' AND time >= to_timestamp('.$oneSecondAgo.') AND time < to_timestamp('.$currentTime.')';
          $result = $pdo->query($strQuery);
        $returnTable="";
        $features=[];
        if ($result) {
            $returnTable.="<tr style='font-size: 20px; color: white;'>";
            $returnTable.="<th style='padding:0.1rem 0.1rem;'>Class</th>";
            $returnTable.="<th style='padding:0.1rem 0.1rem;'>Coords</th>";
            $returnTable.="<th style='padding:0.1rem 0.1rem;'>Confidence</th>";
            $returnTable.="</tr>";
             foreach($result AS $row) {
            $returnTable.="<tr>";
                $returnTable.="<td style='padding:0.4rem 0.1rem;'><button class='object-button'>{$row['Name']}</button></td>";
                $returnTable.="<td style='padding:0.4rem 0.1rem;'>[{$row['lat']},{$row['lon']}] </td>";
            $returnTable.="<td style='padding:0.4rem 0.1rem;'>{$row['conf']} </td>";
            $returnTable.="</tr>";
            $feature=['type'=>'Feature'];
            $feature['geometry']=json_decode($row['geom']);
            unset($row['geom']);
            $feature['properties']=$row;
            array_push($features, $feature);
            }

        }
     
        $featureCollection=['type'=>'FeatureCollection', 'features'=>$features];
         $res = array(json_encode($featureCollection),$returnTable);
         echo json_encode($res);
        }
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            if ($action === 'saveToGeoJson') {
                $jsonString = file_get_contents('C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\05_model_input\\yolox_confidence.json');
                // Decode the JSON string into a PHP object
                $data = json_decode($jsonString);
                // Access the data from the JSON object
                $conf =  $data->threshold;
                $conf = (string)$conf;
                $currentTime = time(); // Current timestamp
                $oneSecondAgo = $currentTime - 60;

                $strQuery_part = 'SELECT id, name as "Name",sahi, ROUND(conf::numeric, 4) as conf, ST_AsGeoJSON(geom, 5) as geom, ST_X(ST_AsText(geom,3)) AS "lon", ST_Y(ST_AsText(geom,3)) AS "lat" FROM yolox_all_targets WHERE conf >='. $conf . ' AND time >= to_timestamp('.$oneSecondAgo.') AND time < to_timestamp('.$currentTime.')';

                $result = $pdo->query($strQuery_part);
                $returnTable="";
                $results=$result->fetchALL();


                // Convert the results to GeoJSON format
                $geojson = array(
                    'type' => 'FeatureCollection',
                    'features' => array()
                );
        
                foreach ($results as $row) {
                    $feature = array(
                        'type' => 'Feature',
                        'geometry' => json_decode($row['geom']),
                        'properties' => array(
                            'id' => $row['id'],
                            'name' => $row['Name'],
                            'conf' => $row['conf'],
                            // 'lon' => $row['lon'],
                            // 'lat' => $row['lat'],
                            'sahi'=>$row['sahi'],
                            'time' =>date('Y-m-d H:i:s'),

                        )
                    );
        
                    array_push($geojson['features'], $feature);
                }
        
                // Convert to JSON format
                $geojsonString = json_encode($geojson, JSON_PRETTY_PRINT);
        
                // Save the GeoJSON data to a file (e.g., attractions.geojson)
                file_put_contents('C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\data\\11_map_objects\\user_objects_data.geojson', $geojsonString);
                echo "Data saved to attractions.geojson successfully.";
            } 
        }

        
    } catch(PDOException $e) {
        echo "ERROR: ".$e->getMessage();
    }