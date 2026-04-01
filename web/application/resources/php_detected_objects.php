<?php
    include "../views/_templates/init.php";
    try {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['filename'])) {
                $target_dir = "C:/xampp\htdocs\webmap\python\imagery-detect\data/01_raw/";
                $target_file = $target_dir . "raw_imagery.jpg";
                move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);
            }
            if (!empty($_FILES['geojsonfile'])) {
                
                $target_file = "C:\\xampp\htdocs\webmap\python\imagery-detect\data\\01_raw\\raw_coords.txt";
                move_uploaded_file($_FILES["geojsonfile"]["tmp_name"], $target_file);
            }
        
            if (!empty($_POST['command'])) {
                $command_venv = "C:\\xampp\\htdocs\\webmap\\python\\imagery-detect\\venv\\Scripts\\activate.bat"; // Replace with the path to your virtual environment
                shell_exec($command_venv);
                shell_exec($_POST['command']); // will return the output to a variable
                }
        }

        $currentTime = time(); // Current  timestamp
        $oneSecondAgo = $currentTime - 60;
        $strQuery_part = 'SELECT id, name as "Name", ROUND(conf::numeric, 4) as conf, ST_AsGeoJSON(geom, 5) as geom, ST_X(ST_AsText(geom,3)) AS "lon", ST_Y(ST_AsText(geom,3)) AS "lat" FROM yolox_all_targets WHERE  time >= to_timestamp('.$oneSecondAgo.') AND time < to_timestamp('.$currentTime.')';
         
        $result = $pdo->query($strQuery_part);
        $returnTable="";
        $row=$result->fetch();
        $features=[];

        if ($row) {
            $returnTable.="<tr style='font-size: 20px; color: white;'>";
            $returnTable.="<th style='padding:0.1rem 0.1rem;'>Class</th>";
            $returnTable.="<th style='padding:0.1rem 0.1rem;'>Coords</th>";
            $returnTable.="<th style='padding:0.1rem 0.1rem;'>Confidence</th>";  
            $returnTable.="</tr>";
            $returnTable.="<tr>";
            $returnTable.="<td style='padding:0.4rem 0.1rem;'><button class='object-button'>{$row['Name']}</button></td>";
            $returnTable.="<td style='padding:0.4rem 0.1rem;'>[{$row['lat']},{$row['lon']}] </td>";
        
        $returnTable.="<td style='padding:0.4rem 0.1rem;'>{$row['conf']}</td>";
        $returnTable.="</tr>";
        $feature=['type'=>'Feature'];
        $feature['geometry']=json_decode($row['geom']);
        unset($row['geom']);
        $feature['properties']=$row;
        array_push($features, $feature);

        }
        foreach($result AS $row) {
            $returnTable.="<tr>";
           
                $returnTable.="<td style='padding:0.4rem 0.1rem;'><button class='object-button'>{$row['Name']}</button></td>";
                $returnTable.="<td style='padding:0.4rem 0.1rem;'>[{$row['lat']},{$row['lon']}] </td>";
            
            $returnTable.="<td style='padding:0.4rem 0.1rem;'>{$row['conf']}</td>";
            $returnTable.="</tr>";
            $feature=['type'=>'Feature'];
            $feature['geometry']=json_decode($row['geom']);
            unset($row['geom']);
            $feature['properties']=$row;
            array_push($features, $feature);
        }
        $featureCollection=['type'=>'FeatureCollection', 'features'=>$features];
         $res = array(json_encode($featureCollection),$returnTable);
         echo json_encode($res);
        
    } catch(PDOException $e) {
        echo "ERROR: ".$e->getMessage();
    }